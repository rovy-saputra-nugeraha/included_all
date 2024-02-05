<?php
    session_start();
    session_destroy();//Penghapusan Sesi
    echo "<script>location='/ppdb-sd/src/login_siswa/index.php'</script>";//Kembalikan ke halaman index
?>