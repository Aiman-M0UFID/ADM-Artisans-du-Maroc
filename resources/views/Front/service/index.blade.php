@extends('Front.artisan.app')

@section('title','ADM Service')
    
@section('content')
<section>
    <div class="container">
        <div class="row m-5">
            <div class="col-md-12">
                <h2 class="text-center">
                    Gestion Service
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
                                <h5>List Services</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('sevice.create')}}" class="btn btn-primary float-end"><i class='bx bx-folder-plus'></i> Ajouter Service</a>
                            </div>
                      </div>
                      </div>
                        <div class="card-body">
                           <div class="row">
                            @foreach ($services as $item)

                            <div class="col-md-6">
                              <div class="card mb-3" style="max-width: 540px;">
                                  <div class="row g-0">
                                    <div class="col-md-4">
                                      <img src="{{asset('images_service/'.$item->image)}}" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card-body">
                                        <p class="card-text">
                                          <small class="text-body-secondary float-end">
                                            <a href="{{route('service.edit',$item->id)}}" class="btn btn-success"><i class='bx bx-edit' ></i></a>
                                            <a href="{{route('service.delete',$item->id)}}" class="btn btn-danger"><i class='bx bx-trash' ></i></a>
                                          </small></p>
                                        <h5 class="card-title">{{$item->nom}}</h5>
                                       <div class="my-3">
                                        <strong>{{$item->title}} </strong><br> <span><i> experience ({{$item->experience}} ans )</i></span>
                                       </div>
                                        <p class="card-text">{{$item->details}}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                                
                            @endforeach
                           </div>
                        </div>
                      </div>

                  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection