<?php 

    namespace views;

    require '../../../app/autoloader.php';
    include '../layouts/main.php';
    use Controllers\auth\LoginController as LoginController;
    head();
?>

<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="" id="login-form">
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" 
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Introuzca su correo electrónico"
                        required>
                </div>
                <div class="form-group">
                    <label for="passwd">Contraseña</label>
                    <input type="password" 
                        class="form-control"
                        id="passwd"
                        name="passwd"
                        required>
                </div>
                <small class="form-text text-danger d-none mb-2" id="error">
                    Sus datos de inicio de sesión son incorrectos.
                </small><br>
                <button class="btn btn-success mt-3" type="submit">
                    Iniciar sesión <i class="bi bi-box-arrow-in-right"></i>
                </button>
            </form>
        </div>
    </div>
</div>
<?php scripts('app.js'); ?>

<script type="text/javascript">
    $(function(){
        const lf = $("#login-form");
        lf.on("submit",function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData();
            data.append("email",$("#email").val());
            data.append("passwd",$("#passwd").val());
            data.append("_login","");
            fetch(app.routes.login,{
                method :"POST",
                body : data
            })
            .then( resp => resp.json())
            .then( resp => {
                //.....procesar respuesta de inicio de sesión
                console.info("Resultado: ",resp.r);
                if(resp.r !== false){
                    location.href = "../home.php";
                }else{
                    $("#error").removeClass("d-none");
                }
            }).catch( err => console.error( "Error: " + err ));
        });
    });

</script>

<?php

    foot();