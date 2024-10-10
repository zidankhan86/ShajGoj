<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - eCommerce</title>
</head>
<body>
    <div style="max-width: 400px; margin: 0 auto; padding: 20px; text-align: center; font-family: Arial, sans-serif;">
       
        <h2 style="margin: 10px 0;">{{ auth()->user()->name }}</h2>
        <p style="color: #777;">Joined: {{ auth()->user()->created_at->diffForHumans() }}</p>

        <ul style="list-style: none; padding: 0; text-align: left;">
            <form action="logout.php" method="post">

            <li>
                <strong>Address: </strong> {{ auth()->user()->address }}<br>

            </li>
            <li>
                <strong>Phone: </strong>{{ auth()->user()->phone }}<br>

            </li>
            <li>
                <strong>Email: </strong>{{ auth()->user()->email }}<br>

            </li>
           
             </form>
                        </ul><br><br>
                    </div><br><br>
                            <!-- Booking History -->
                            <h3>Order History</h3><br>                 
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Order Name</th>
                                  <th scope="col">Order ID</th>
                                  <th scope="col">Pay</th>
                                  <th scope="col">Placed On</th>
                                  <th scope="col">Status</th>
 
                              </tr>
                          </thead>
                          <tbody>
                              @if (empty($order))
                              <tr>
                                  <td colspan="8">No Order History</td>
                              </tr>
                              @else
                              @foreach ($order as $index => $item)
                              <tr>
                                  <th scope="row">{{ $index + 1 }}</th>
                                  <td>{{ $item->name }}</td>
                                  <td>#{{ $item->total_price }}{{ $item->id }}67890</td>
                                  <td>BDT {{ $item->total_price }}</td>
                                  <td>{{ $item->created_at }}</td>
                                  <td>{{ $item->status }}</td>
                                 
                                  
                              </tr>
                              @endforeach
                              @endif
                          </tbody>
                      </table>
                  </div>

    </div>
</body>
</html>
