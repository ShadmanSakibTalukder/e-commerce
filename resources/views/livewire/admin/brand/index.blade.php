<div>

    @include('livewire.admin.brand.modal-form')
 <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Brands List
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm float-end">Add Brands</a>
                </h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $item)
                        <tr>
                            <td>{{$brands->id}}</td>
                            <td>{{$brands->name}}</td>
                            <td>{{$brands->slug}}</td>
                            <td>{{$brands->status == '1' ? 'hidden':'visible'}}</td>
                            <td>
                                <a href="" class="btn btn-sm btn success"></a>
                                <a href="" class="btn btn-sm btn danger"></a>
                            </td>
                        </tr>
                            
                        @empty
                        <tr>
                            <td colspan="5"> No Brands Found </td>
                        </tr>
                            
                        @endforelse
                        
                    </tbody>

                </table>
            </div>

            {{$brands -> links()}}
        </div>
    </div>
 </div>

</div>


@push('script')

<script>
    window.addEventListner('close-modal', event=>{
        $('#addBrandModal').modal('hide');
    })
</script>
    
@endpush
