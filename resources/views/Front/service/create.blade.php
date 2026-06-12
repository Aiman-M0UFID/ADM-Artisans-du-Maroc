@extends('Front.artisan.app')

@section('title','ADM Create Service')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Ajouter Service</h2>
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
                              <h5>Service</h5>
                          </div>
                          <div class="col-md-6">
                              <a href="{{route('sevice')}}" class="btn btn-primary float-end"><i class='bx bx-home'></i> Services</a>
                          </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="m-4">
                                <label for="nom" class="form-label">Nom service</label>
                                <input type="text" name="nom" placeholder="Entrez nom service" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                </div>
                                <div class="m-4">
                                    <label for="Title" class="form-label">Title service</label>
                                    <input type="text" name="title" placeholder="Entrez title service" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    </div>
                                <div class="m-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-4">
                                <label for="experience" class="form-label">Expérience</label>
                                <input type="number" name="experience" placeholder="Entrez experience service" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="m-4">
                                    <label for="categorie" class="form-label">Catégories</label>
                                    <select class="form-select" name="categorie_id" aria-label="Default select example">
                                        <option selected value="">une catégorie pour votre service</option>
                                      
                                        @foreach ($categories as $item)
                                           <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach

                                      </select>
                                </div>
                                <div class="m-4">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea class="form-control" name="details" placeholder="Entrez plus de details" id="floatingTextarea"></textarea>
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