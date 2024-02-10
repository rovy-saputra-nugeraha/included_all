<?php
    session_start();
    session_destroy();//Penghapusan Sesi
    echo "<script>location='/included_all/loginsiswa.php'</script>";//Kembalikan ke halaman index
?>