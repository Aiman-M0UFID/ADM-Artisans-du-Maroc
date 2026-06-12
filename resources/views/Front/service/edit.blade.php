@extends('Front.artisan.app')

@section('title','ADM Modifer Service')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Modifer Service</h2>
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
                    <form action="{{route('service.update',$service->id)}}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="m-4">
                                <label for="nom" class="form-label">Nom service</label>
                                <input type="text" value="{{$service->nom}}" name="nom" placeholder="Entrez nom service" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                </div>
                                <div class="m-4">
                                    <label for="Title" class="form-label">Title service</label>
                                    <input type="text" value="{{$service->title}}" name="title" placeholder="Entrez title service" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    </div>
                                
                                    <div class="m-4">
                                        <label for="experience" class="form-label">Expérience</label>
                                        <input type="number" value="{{$service->experience}}" name="experience" placeholder="Entrez experience service" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="m-4">
                                            <label for="categorie" class="form-label">Catégories </label><a href="{{route('sevice.create')}}" class="btn-primary float-end"><i class='bx bx-folder-plus'></i> Ajouter categorie</a>

                                            @foreach ($categories as $item)
                                                @if ($item->id == $service->categorie_id)
                                                <h6 class="my-3"> Catégorie actuelle : {{$item->title}}</h6>
                                                @endif
                                            @endforeach
                                          
                                            <select class="form-select" name="categorie_id" aria-label="Default select example">
                                                <option selected value="">une catégorie pour votre service</option>
                                              
                                                @foreach ($categories as $item)
                                                   <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
        
                                              </select>
                                        </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-4">
                                    <img  style="height: 200px;width:auto" src="{{asset('images_service/'.$service->image)}}" alt="{{$service->image}}">
                                </div>
                                <div class="m-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" >
                                    </div>
                                <div class="m-4">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea class="form-control" value="" name="details" placeholder="Entrez plus de details" id="floatingTextarea">{{$service->details}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mx-4">
                                <input value="Save" type="submit" class="btn btn-primary">
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