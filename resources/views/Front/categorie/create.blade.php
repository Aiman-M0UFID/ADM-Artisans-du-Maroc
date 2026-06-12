@extends('Front.admin.app')

@section('title','ADM Create Catégorie')

@section('content')
<section>
    <div class="container">
        <div class="row m-5">
            <div class="col-md-12">
                <h2 class="text-center">Ajouter Catégorie</h2>
            </div>
        </div>
       
        <div class="row mx-5">
            <div class="col-md-12">

                @if(Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error')}}
                </div>
                @endif

                @if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success')}}
                </div>
                @endif

            </div>
        </div>
        
       <div class="row m-5"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                          <div class="col-md-6">
                              <h5>Catégorie</h5>
                          </div>
                          <div class="col-md-6">
                              <a href="{{route('categorie')}}" class="btn btn-primary float-end"><i class='bx bx-home'></i> Catégories</a>
                          </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <form action="{{route('categorie.store')}}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="m-4">
                                <label for="Title" class="form-label">Title categorie</label>
                                <input type="text" name="title" placeholder="Entrer title catégorie" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="m-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-4">
                                <label for="Sub_title" class="form-label">Sub Title</label>
                                <input type="text" name="sub_title" placeholder="Entrer sub_title catégorie" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mx-4">
                                <input value="Ajouter" type="submit" class="btn btn-primary">
                                <input value="Annuler" type="reset" class="btn btn-secondary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div> 
</section>
    
@endsection