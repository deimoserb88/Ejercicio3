const app = {

    routes : {
        inisesion: "/resources/views/auth/login.php",
        login    : "/app/app.php",
        logout   : "/app/app.php?_logout",
        newpost  : "/resources/views/newpost.php",
        prevposts: "/app/app.php?_pp",
        lastpost : "/app/app.php?_lp",
        openpost : "/app/app.php?_op",
        likepost : "/app/app.php?_likepost",
        
    },
    uid : "",
    sv : false,
    pp : $("#prev-posts"),
    lp : $("#content"),
    view : function(route){
        location.replace(app.routes[route]);
    },
    previousPosts : function(){
        let html = `<b>Aún no hay publicaciones en este Blog</b>`;
        this.pp.html("");
        fetch(this.routes.prevposts)
            .then( response => response.json())
            .then( ppresp => {
                if( ppresp.length > 0){
                    html = "";
                    let primera = true;
                    for( let post of ppresp ){
                        console.log(post);
                        html += `
                            <a href="#" onclick="app.openPost(event,${ post.id },this)"
                                class="list-group-item list-group-item-action ${ primera ? `active` : `` } pplg">
                                <div class="w-100 border-bottom">
                                    <h5 class="mb-1">${ post.title }</h5>
                                    <small class="text-${ primera ? `light` : `muted` }">
                                        <i class="bi bi-calendar-week"></i>
                                        ${ post.fecha }
                                    </small>
                                </div>
                                <p class="mb-1">${ post.body.substr(0,100) } ...</p>
                                    <small>
                                        <i class="bi bi-person-circle"></i>
                                        <b>${ post.name }</b>
                                    </small>
                                </a>
                        `;
                        primera = false;
                    }
                    this.pp.html(html);
                }
            }).catch( err => console.error( err ));
    },
    lastPost : function(limit){
        let html = "<h2>Aún no hay publicaciones</h2>";
        this.lp.html("");
        
        fetch(this.routes.lastpost + "&limit=" + limit)
            .then( response => response.json())
            .then( lpresp => {
                if( lpresp.length > 0){
                    html = `
                        <div class="w-100 border-bottom">
                            <h5 class="mb-1">${ lpresp[0].title }</h5>
                            <small class="text-muted">
                                <i class="bi bi-calendar-week"></i> ${ lpresp[0].fecha } |
                                <i class="bi bi-person-circle"></i> <b>${ lpresp[0].name }</b>
                            </small>
                        </div>
                        <p class="mb-1 border-bottom">${ lpresp[0].body }</p>                        
                        <button type="button" 
                            class="btn btn-link ${ !this.sv ? "disabled" : "" }" 
                            style="text-decoration:none;" 
                            onclick="app.likePost(${ lpresp[0].id },${ this.uid })">
                            <i class="bi bi-hand-thumbs-up"></i> ${ lpresp[1].tt }
                        </button> 

                    `;
                }
                this.lp.html(html);
            }).catch( err => console.error( err ));

    },
    openPost : function(event,pid,element){
        event.preventDefault();
        $(".pplg").removeClass('active');
        element.classList.add("active");
        this.lp.html("");
        let html = "";
        fetch(this.routes.openpost + "&pid=" + pid)
            .then( response => response.json())
            .then( post => {
                console.log(post[0]);
                html = `
                    <div class="w-100 border-bottom">
                        <h5 class="mb-1">${ post[0].title }</h5>
                        <small class="text-muted">
                            <i class="bi bi-calendar-week"></i>${ post[0].fecha } |
                            <i class="bi bi-person-circle"></i><b>${ post[0].name }</b>
                        </small>
                    </div>
                    <p class="mb-1">${ post[0].body }</p>
                    <button type="button" 
                        class="btn btn-link ${ !this.sv ? "disabled" : "" }" 
                        style="text-decoration:none;" 
                        onclick="app.likePost(${ post[0].id },${ this.uid })">
                        <i class="bi bi-hand-thumbs-up"></i> ${ post[1].tt }
                    </button> 
                `;
                this.lp.html(html);
            }).catch( err => console.error( "Error al abrir la pulicación : ",err ));


    },

    likePost : function(pid,uid){
        fetch(this.routes.likepost + "&pid=" + pid + "&uid=" + uid)
            .then( response => response.json())
            .then( resp => {
                //console.log(resp);
            }).catch( err => console.error( err ));
    }

   

};