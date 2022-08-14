<script>
  $('.akses-peran').on('click', function() { // script untuk ubah akses di pengaturan role
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');
    $.ajax({
      url: "<?= base_url('admin/ubahaksesperan'); ?>",
      type: 'post',
      data: {
        menuId: menuId,
        roleId: roleId
      },
      success: function() {
        document.location.href = "<?= base_url('admin/peran'); ?>";
      }
    });
  });
</script>