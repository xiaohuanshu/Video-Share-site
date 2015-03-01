function iwish(id){
    $.ajax({
        type: "GET",
        url: "/share/home/movie/iwish",
        data: { movieid: id }
    });
}
function ifa(id){
    $.ajax({
        type: "GET",
        url: "/share/home/movie/ifa",
        data: { movieid: id }
    });
}
function downloadinc(id){
    $.ajax({
        type: "GET",
        url: "/share/home/movie/downloadinc",
        data: { movieid: id }
    });
}