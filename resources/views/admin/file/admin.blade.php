@extends('admin.layout.layout')

@section('heading', 'Admin')
@section('button')
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Add</button>
@endsection
 @section('content')

<div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($admin as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                   <td>{{$row->name}}</td>
                                                   <td>{{$row->email}}</td>
                                                   <td>{{$row->user_type == 1 ? 'admin':'superadmin'}}</td>
                                              </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="userForm">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email"  placeholder="name@example.com">
                <small class="text-danger" id="emailError"></small>

              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
                <small class="text-danger" id="nameError"></small>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="text" class="form-control" name="password">
                <small class="text-danger" id="passwordError"></small>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input type="number" class="form-control" name="phone">
              </div>
              <div class="mb-3">
                <label class="form-label">Address*</label>
                <textarea  name="address" class="form-control" cols="50" rows="50" value=""></textarea>
            </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <input type="text" class="form-control" name="city">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
              </div>
            </form>
        </div>
       
      </div>
    </div>
  </div>
  <div class="modal modal-right fade" id="updateAdmin" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modelHeading">Edit Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="UpdateAdminForm">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="user_id" id="user_id" value="">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input name="name" id="name" value="" placeholder="Enter Name" type="text" class="form-control" />
              <small class="text-danger" id="nameError"></small>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input name="email" id="email" value="" placeholder="Enter Email" type="text" class="form-control" />
              <small class="text-danger" id="emailError"></small>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="phne" id="phone" value="" placeholder="Enter Phone" type="number" class="form-control" />
                <small class="text-danger" id="phoneError"></small>
              </div>
              <div class="mb-3">
                <label class="form-label">Address</label>
                <input name="address" id="address" value="" placeholder="Enter Address" type="text" class="form-control" />
                <small class="text-danger" id="addressError"></small>
              </div>
              <div class="mb-3">
                <label class="form-label">Country</label>
                <input name="country" id="country" value="" placeholder="Enter Country Name" type="text" class="form-control" />
                <small class="text-danger" id="countryError"></small>
              </div>
              <div class="mb-3">
                <label class="form-label">City</label>
                <input name="city" id="city" value="" placeholder="Enter City" type="text" class="form-control" />
                <small class="text-danger" id="cityError"></small>
              </div>
            <div>
              <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="updateAdminBtn">Update</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

<script>

$(function()
{
    var table = $('#example1').DataTable();

 getData();
    function getData()
    {
        $.ajax({
    type: "GET",
    url: route('admin.admingetData'),
    dataType: "json",
    success:function(res)
    {
        // console.log(res.user);
       
    }
});
    }

     // ............. create or update store .......... 
     $('#saveBtn').on('click',function(e) {
        e.preventDefault();
          
        var formData = new FormData($("#userForm")[0]);
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        // console.log(formData);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:'POST',
          url: route('admin.adminPost'),
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
              Toast.fire({
                icon: 'success',
                title: 'Admin Create successfully'
              })
              getData();
          //  console.log(data);
              $('#userForm').trigger("reset");
              $('#exampleModal').modal('hide');
          },
          error: function(data){   
            console.log(data);
              $("#nameError").text(data.responseJSON.name);
              $("#emailError").text(data.responseJSON.email);
            
          }
        });
    });

});

</script>


@endsection