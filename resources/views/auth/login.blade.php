
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login-Inventario</title>

    <!-- Bootstrap -->
    <link href="{{url('/')}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('/')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('/')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{url('/')}}/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('/')}}/css/custom.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
      body{
        background-image: url("{{url('/')}}/img/fondologin.jpg");
        width: 100%;
        height: 100%;
        background-attachment: fixed;
      }
    </style>

  </head>

  <body>
    <div class="container">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <button type="button" id="load" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#loading">
      
      </button>

      <!-- Modal -->
      <div class="modal fade" id="loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loadingLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="">
                  <div class="modal-body text-center">
                      <img src="{{url('')}}/img/loading.gif" width="100%" height="100%" alt="">
                  </div>
              </div>
          </div>
      </div>

      <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" id="cont">
        <div class="login_wrapper">
          <div class="animate form login_form">
            <section class="login_content">
              <form method="POST" id="form" action="{{ route('login') }}">
                  @csrf
                <h1>Inicio de sección</h1>
                <div>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="Nombre usuario" autofocus />
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
                <div>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña"  name="password">
                  
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="d-grid gap-2">
                  <button class="btn btn-outline-dark" id="btnSubmit" type="submit">Iniciar sesión</button>
                </div>

                <div class="clearfix"></div>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
    
    <script src="{{url('/')}}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script>
      
      $("#btnSubmit").click(function () {
        $("#form").submit();
        // $(this).prop("disabled",true);
        $("#load").click();

        $("#cont").html('');
      });
    </script>
  </body>
</html>
