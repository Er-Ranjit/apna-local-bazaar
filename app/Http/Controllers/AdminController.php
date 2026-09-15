<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAssignment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $usersCount = User::count();
        $vendorsCount = Vendor::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $confirmedOrders = Order::where('status', 'confirmed')->count();

        $preparingOrders = Order::where('status', 'preparing')->count();

        $outForDeliveryOrders = Order::where(
            'status',
            'out_for_delivery'
        )->count();

        $deliveredOrders = Order::where(
            'status',
            'delivered'
        )->count();

        $lowStockProducts = Product::where('is_active', true)
            ->where('stock', '<=', 5)
            ->with(['vendor', 'category'])
            ->latest()
            ->get();

        $recentOrders = Order::with([
            'user',
            'items.product.vendor',
        ])
            ->latest()
            ->take(5)
            ->get();

        $recentAssignments = DeliveryAssignment::with([
            'order',
            'deliveryBoy.user',
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'usersCount',
            'vendorsCount',
            'productsCount',
            'ordersCount',
            'pendingOrders',
            'confirmedOrders',
            'preparingOrders',
            'outForDeliveryOrders',
            'deliveredOrders',
            'lowStockProducts',
            'recentOrders',
            'recentAssignments'
        ));
    }


    /**
     * Users Management
     */
    public function users(Request $request)
    {
        $query = User::query();

        /*
        |--------------------------------------------------------------------------
        | Search by name or email
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Filter by role
        |--------------------------------------------------------------------------
        */
        if ($request->filled('role')) {

            $query->where(
                'role',
                $request->role
            );
        }


        $users = $query
            ->latest()
            ->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }


    /**
     * Vendors Management
     */
    public function vendors(Request $request)
    {
        $query = Vendor::with('user');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'shop_name',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'phone',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'city',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('user', function ($userQuery) use ($search) {

                    $userQuery
                        ->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $search . '%'
                        );

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Active / Inactive
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {

            if ($request->status === 'active') {

                $query->where(
                    'is_active',
                    true
                );

            }

            if ($request->status === 'inactive') {

                $query->where(
                    'is_active',
                    false
                );

            }

        }


        $vendors = $query
            ->latest()
            ->get();

        return view(
            'admin.vendors.index',
            compact('vendors')
        );
    }


    /**
     * Products Management
     */
    public function products(Request $request)
    {
        $query = Product::with([
            'vendor',
            'category',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Search Product / Vendor / Category
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('vendor', function ($vendorQuery) use ($search) {

                    $vendorQuery->where(
                        'shop_name',
                        'like',
                        '%' . $search . '%'
                    );

                })

                ->orWhereHas('category', function ($categoryQuery) use ($search) {

                    $categoryQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Stock Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('stock')) {

            switch ($request->stock) {

                case 'in_stock':

                    $query->where(
                        'stock',
                        '>',
                        0
                    );

                    break;


                case 'low_stock':

                    $query->whereBetween(
                        'stock',
                        [1, 5]
                    );

                    break;


                case 'out_of_stock':

                    $query->where(
                        'stock',
                        '<=',
                        0
                    );

                    break;

            }
        }


        /*
        |--------------------------------------------------------------------------
        | Product Status Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {

            if ($request->status === 'active') {

                $query
                    ->where('is_active', true)
                    ->where('is_available', true);

            }


            if ($request->status === 'inactive') {

                $query->where(function ($q) {

                    $q->where(
                        'is_active',
                        false
                    )

                    ->orWhere(
                        'is_available',
                        false
                    );

                });

            }

        }


        $products = $query
            ->latest()
            ->get();

        return view(
            'admin.products.index',
            compact('products')
        );
    }


    /**
     * Orders Management
     */
    public function orders(Request $request)
    {
        $query = Order::with([
            'user',
            'address',
            'items.product.vendor',
            'deliveryAssignment.deliveryBoy.user',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Search Order Number / Customer
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'order_number',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('user', function ($userQuery) use ($search) {

                    $userQuery
                        ->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $search . '%'
                        );

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Order Status
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Payment Status
        |--------------------------------------------------------------------------
        */
        if ($request->filled('payment')) {

            $query->where(
                'payment_status',
                $request->payment
            );
        }


        $orders = $query
            ->latest()
            ->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }


    /**
 * Delivery Assignments Management
 */
public function deliveryAssignments(Request $request)
{
    $query = DeliveryAssignment::with([
        'order.user',
        'deliveryBoy.user',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Search Order / Customer / Delivery Boy
    |--------------------------------------------------------------------------
    */
    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            // Order number or customer
            $q->whereHas('order', function ($orderQuery) use ($search) {

                $orderQuery
                    ->where('order_number', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {

                        $userQuery
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');

                    });

            });


            // Delivery boy name or email
            $q->orWhereHas(
                'deliveryBoy.user',
                function ($userQuery) use ($search) {

                    $userQuery
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');

                }
            );

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Delivery Status Filter
    |--------------------------------------------------------------------------
    */
    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Assignment Records
    |--------------------------------------------------------------------------
    */
    $assignments = $query
        ->latest()
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Delivery Summary Counters
    |--------------------------------------------------------------------------
    | These counters always show the overall system status,
    | not the currently filtered table results.
    |--------------------------------------------------------------------------
    */

    $totalAssignments = DeliveryAssignment::count();

    $assignedAssignments = DeliveryAssignment::where(
        'status',
        'assigned'
    )->count();

    $outForDeliveryAssignments = DeliveryAssignment::where(
        'status',
        'out_for_delivery'
    )->count();

    $deliveredAssignments = DeliveryAssignment::where(
        'status',
        'delivered'
    )->count();


    /*
    |--------------------------------------------------------------------------
    | Return View
    |--------------------------------------------------------------------------
    */
    return view(
        'admin.delivery-assignments.index',
        compact(
            'assignments',
            'totalAssignments',
            'assignedAssignments',
            'outForDeliveryAssignments',
            'deliveredAssignments'
        )
    );
}
    public function showOrder(Order $order)
{
    $order->load([
        'user',
        'address',
        'items.product.vendor',
        'deliveryAssignment.deliveryBoy.user',
    ]);

    return view('admin.orders.show', compact('order'));
}
/**
 * Toggle Vendor Active Status
 */
public function toggleVendor(Vendor $vendor)
{
    $vendor->update([
        'is_active' => ! $vendor->is_active,
    ]);

    return back()->with(
        'success',
        $vendor->is_active
            ? 'Vendor activated successfully.'
            : 'Vendor deactivated successfully.'
    );
}


/**
 * Toggle Product Active Status
 */
public function toggleProduct(Product $product)
{
    $product->update([
        'is_active' => ! $product->is_active,
    ]);

    return back()->with(
        'success',
        $product->is_active
            ? 'Product activated successfully.'
            : 'Product deactivated successfully.'
    );
}


/**
 * Toggle Product Availability
 */
public function toggleProductAvailability(Product $product)
{
    $product->update([
        'is_available' => ! $product->is_available,
    ]);

    return back()->with(
        'success',
        $product->is_available
            ? 'Product is now available.'
            : 'Product is now unavailable.'
    );
}

/**
 * Block / Unblock User
 */
public function toggleUser(User $user)
{
    // Admin account ko block nahi karne dena
    if ($user->role === 'admin') {
        return back()->with(
            'error',
            'Admin account cannot be blocked.'
        );
    }

    $user->update([
        'is_active' => ! $user->is_active,
    ]);

    return back()->with(
        'success',
        $user->is_active
            ? 'User unblocked successfully.'
            : 'User blocked successfully.'
    );
}


}