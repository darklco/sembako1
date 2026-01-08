
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #e58423;
            padding-bottom: 15px;
        }

        h2 {
            color: #642714;
            font-size: 28px;
            margin: 0;
        }

        .btn-add {
            background: linear-gradient(135deg, #e58423 0%, #ec9105 100%);
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(229, 132, 35, 0.3);
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #d67520 0%, #d68204 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(229, 132, 35, 0.4);
        }

        .btn-add::before {
            content: '+';
            font-size: 16px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        th {
            background: linear-gradient(135deg, #e58423 0%, #ec9105 100%);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background-color: #fff8e7;
            transform: scale(1.01);
        }

        td img {
            border-radius: 6px;
            object-fit: cover;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        td img:hover {
            transform: scale(1.1);
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-edit {
            background: linear-gradient(135deg, #ec9105 0%, #e58423 100%);
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #d68204 0%, #d67520 100%);
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(236, 145, 5, 0.3);
        }

        .btn-edit::before {
            content: '✎';
            font-size: 13px;
        }

        .btn-delete {
            background: linear-gradient(135deg, #ed6325 0%, #d24f01 100%);
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #d24f01 0%, #b84401 100%);
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(237, 99, 37, 0.3);
        }

        .btn-delete::before {
            content: '🗑';
            font-size: 12px;
        }

        .delete-form {
            display: inline;
            margin: 0;
        }

        .price {
            color: #e58423;
            font-weight: 600;
            font-size: 15px;
        }

        .stock {
            background: linear-gradient(135deg, #e7c481 0%, #f0d49e 100%);
            color: #642714;
            padding: 3px 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
        }

        .no-image {
            color: #999;
            font-style: italic;
            font-size: 12px;
        }

        .product-name {
            color: #642714;
            font-weight: 600;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
    {{-- @extends('admin.layouts.sidebar') --}}
    <div class="container">
        <div class="header">
            <h2>Product Data</h2>
            <a href="{{ route('admin.products.create') }}" class="btn-add">Add Product</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td><span class="product-name">{{ $product->name }}</span></td>
                    <td><span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span></td>
                    <td><span class="stock">{{ $product->stock }} pcs</span></td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" width="60" height="60" alt="{{ $product->name }}">
                        @else
                            <span class="no-image">No image</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>