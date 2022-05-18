<?php

namespace views;

require_once "../../app/autoloader.php";

include "layouts/main.php";

use Controllers\auth\LoginController as LoginController;

$ua = new LoginController;

is_null($ua->sessionValidate()) ? header('Location: /resources/views/auth/login.php') : '';

head($ua);

?>

<section class="container pt-5">

    <div class="card">
        <div class="card-header">
            <h1 class="border-bottom">Mis publicaciones</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody id="my-posts">

                </tbody>
            </table>
        </div>
    </div>

</section>
<?php

scripts("app_myposts.js");

?>
<script>
    $(function(){
        app_myposts.getMyPosts(<?=$ua->uid?>);
    });
</script>

<?php

foot();