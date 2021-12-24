<!-- load file layout.blade.php vao day -->
@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-12">  
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit category</div>
        <div class="panel-body">
        <form method="post" action="">
            <!-- trong laravel, muon bat duoc du lieu thi co tag csrf() -->
            <!-- viet tuong minh ham csrf(): <input type='hidden' name='csrf_token' value='...' -->
        	@csrf
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">
                    <input type="text" value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control">
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Description</div>
                <div class="col-md-10">
                   <textarea style="width: 100%; height: 150px;" name="description">{{ isset($record->description)?$record->description:'' }}</textarea>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="submit" value="Process" class="btn btn-primary">
                </div>
            </div>
            <!-- end rows -->
        </form>
        </div>
    </div>
</div>
@endsection("do-du-lieu")