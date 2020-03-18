<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Title</th>
        </tr>
        @foreach($data as $post)
        <tr>
            <td>{{ $post['id'] }}</td>
            <td>{{ $post['title'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
<style type="text/css">
	.pagination{
    list-style: none;
    display: inline-flex;
}
.pagination li {
	padding-left: 5px;
	padding-right: 5px;
}
</style>   
{{ $data->setPath('paginate') }}