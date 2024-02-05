<?php
    session_start();
    session_destroy();//Penghapusan Sesi
    echo "<script>location='/ppdb-sd/src/admin_menu/login.php'</script>";//Kembalikan ke halaman index
?>