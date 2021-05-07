<table class="table table-bordered table-sm table-condensed">
    <thead>
    <tr>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Location</th>
        <th>Username</th>
        <th>Password</th>
        <th>Contact</th>
        <th>Actions</th>
    </tr>
    </tr>
    </thead>
    <tbody>
    @forelse($customers as $customer)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{link_to_route('customer.show',$customer->name,$customer->id)}}</td>
            <td>{{link_to_route('location.show',$customer->location->name,$customer->location->id)}}</td>
            <td>{{$customer->username}}</td>
            <td>{{$customer->password}}</td>
            <td>{{$customer->primary_contact}}</td>
            <td>{{link_to_route('customer.show',"Show",$customer->id,['class'=>'btn btn-sm btn-primary'])}}</td>
        </tr>
    @empty
        <tr>
            <td>No Customers Found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
