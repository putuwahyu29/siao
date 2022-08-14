<script>
  $('.custom-file-input').on('change', function() { // script upload foto di edit prodil
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
</script>