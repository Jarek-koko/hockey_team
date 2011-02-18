this.tootipshow = function(){
     jQuery("a.tooltip").hover(function(e){
            this.t = this.title;
            this.title = "";
            var c = (this.t != "") ? "<span>" + this.t + "</span>" : "";
             jQuery("body").append("<div id='tooltip'><img src='"+ this.rel +"' alt='photo' />"+ c +"</div>");
             jQuery("#tooltip")
                    .css("top",(e.pageY - 300) + "px")
                    .css("left",(e.pageX - 60) + "px")
                    .animate({opacity: "show", top:(e.pageY - 200)}, "slow");


     },
    function(){
            this.title = this.t;
             jQuery("#tooltip").remove();
     });
     jQuery("a.tooltip").mousemove(function(e){
             jQuery("#tooltip")
                    .css("top",(e.pageY - 200) + "px")
                    .css("left",(e.pageX - 60) + "px");
    });
};
jQuery(document).ready(function(){ tootipshow();});