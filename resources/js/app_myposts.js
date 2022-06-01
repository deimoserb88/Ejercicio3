const app_myposts = {

    url : "/app/app.php",

    mp : $("#my-posts"),

    getMyPosts : function(uid){

        let html = `<tr><td colspan="3">No tiene publicaciones</td></tr>`;

        this.mp.html("");

        fetch(this.url + "?_mp&uid=" + uid)
            .then( resp => resp.json())
            .then( mpresp => {
                if(mpresp.length > 0){
                    html = "";
                    for( let post of mpresp ){
                        html += `<tr>
                                    <td>${ post.title }</td>
                                    <td>${ post.created_at }</td>
                                    <td>
                                        <i class="bi bi-pencil-fill"></i>
                                        <button class="btn btn-link text-danger btn-dp" type="button" onclick="app_myposts.deletePost(${ post.id },${ uid })"> 
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>`;
                    }
                }
                this.mp.html(html);
            }).catch( err => console.error( err ));

    },
    deletePost : function(pid,uid){
        if(confirm("Borrar publicación")){
            fetch(this.url + "?_dp&pid=" + pid)
                .then( response => response.json())
                .then( resp => {
                    if(resp.r){
                        alert("La publicación se eliminó correctametne");
                        this.getMyPosts(uid);
                    }else{
                        alert("La publicación no se pudo borrar, comuníquese con el admin del Blog");
                    }
                }).catch( err => console.error("Hubo un error en el servidor: " + err));
        }else{
            alert("Acción cancelada");
        };
    }

}