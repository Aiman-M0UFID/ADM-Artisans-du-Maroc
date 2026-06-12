@extends('Front.admin.app')

@section('title','ADM Categorie')
    
@section('content')
<section>
    <div class="container">
        <div class="row m-5">
            <div class="col-md-12">
                <h2 class="text-center">
                    Gestion Catégorie
                </h2>
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

            <div class="row my-5">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                      <div class="row">
                            <div class="col-md-6">
                                <h5>List Catégories</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('categorie.create')}}" class="btn btn-primary float-end"><i class='bx bx-folder-plus'></i> Ajouter Catégorie</a>
                            </div>
                        </div>
                      </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sub Title</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  @php
                                      $i=1;
                                  @endphp
                                  @foreach ($categories as $categorie)
                                    <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td><img style="width:100px;height:auto;" src="{{asset('images_categorie/'.$categorie->image)}}" alt="{{$categorie->image}}"></td>
                                      <td>{{$categorie->title}}</td>
                                      <td>{{$categorie->sub_title}}</td>
                                      <td>
                                        <a href="{{route('categorie.edit',$categorie->id)}}" class="btn btn-success"><i class='bx bx-edit' ></i></a>
                                        <a href="{{route('categorie.delete',$categorie->id)}}" class="btn btn-danger"><i class='bx bx-trash' ></i></a>
                                      </td>
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
</section>
@endsection