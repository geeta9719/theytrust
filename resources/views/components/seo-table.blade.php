@props(['seo'])



<div class="card">
    <div class="card-body table-responsive p-0">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>usage_count</th>
                    <th>url</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seo as $item)
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->usage_count}}</td>
                        <td>
                            <a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('seo.destroy', $item->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this SEO item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>