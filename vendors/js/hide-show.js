$(document).ready(function() {
  $(".show-more a").on("click", function(e) {
      e.preventDefault();

      var $this = $(this);
      var $content = $this.parent().prev("div.content");
      var linkText = $this.text().toUpperCase();

      if(linkText === "SHOW MORE"){
          linkText = "Show less";
          $this.text(linkText);
          $content.switchClass("hideContent", "showContent", 'slow');
      } else {
          linkText = "Show more";
          $this.text(linkText);
          $content.switchClass("showContent", "hideContent", 'slow');
      };

      return false;
  });
});