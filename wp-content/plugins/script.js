jQuery(document).ready(function($){
    $.ajax({
        url: '/wp-json/actorcall/rest-ajax'
    }).done(function(data){
        console.log(data.total_pages);

        for (let i = 0; i < 10; i++) {

            let genre = data.results[i].genre_ids.toString();
            
            let temp = genre.split(",");
            let genre_str = '';
            $.each(temp, function(j,v) { // loop through array
                genre_str += "<p class='genre'>"+v+"</p>"; // create html string and store it in str variable
              });


            $('#actor-list').append($('<ul class="'+data.results[i].id+'"></ul>'));

            $('#actor-list ul.'+ data.results[i].id +'').append($('<li class="title">' + data.results[i].title + '</li>'));
            $('#actor-list ul.'+ data.results[i].id +'').append($('<img src="https://image.tmdb.org/t/p/w200/' + data.results[i].poster_path +'" alt="' + data.results[i].title + '">'));
            $('#actor-list ul.'+ data.results[i].id +'').append($('<li>' + data.results[i].release_date + '</li>'));
            $('#actor-list ul.'+ data.results[i].id +'').append($('<div class="genre-container"></div>'));
            $('#actor-list ul.'+ data.results[i].id +' .genre-container').append($(genre_str));

        } 

    });

});