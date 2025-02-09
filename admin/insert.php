<?php

if (isset($_POST['submit'])) {

  
    $product_id = mysqli_real_escape_string($con, $_POST['Id']);
    $product_name = mysqli_real_escape_string($con, $_POST['Tname']);
    $product_image = $_FILES['Pimage'];
    $product_p3price = mysqli_real_escape_string($con, $_POST['P3price']);
    $product_p6price = mysqli_real_escape_string($con, $_POST['P6price']);
    $product_p12price = mysqli_real_escape_string($con, $_POST['P12price']);
    $product_description = mysqli_real_escape_string($con, $_POST['description']);
    $product_subject = mysqli_real_escape_string($con, $_POST['subject']);

    // Check for years inputs
    $years = [];
    for ($i = 0; $i <= 9; $i++) {
        $year_key = 'years' . ($i === 0 ? '' : $i);
        $years[$i] = isset($_POST[$year_key]) ? mysqli_real_escape_string($con, $_POST[$year_key]) : null;
    }

    // Process PDF uploads
    $pdf_files = [];
    $pdf_file_key = 'pdfFile'; // You can adjust this if your input name is different
    if (isset($_FILES[$pdf_file_key])) {
        // Handle the case for one PDF file
        if ($_FILES[$pdf_file_key]['error'] == 0) {
            $pdf_files[] = $_FILES[$pdf_file_key]; // Add the first PDF file
        }

        // Handle multiple PDF files (if applicable)
        for ($i = 1; $i <= 5; $i++) {
            $pdf_key = 'pdfFile' . $i; // Adjust this if your input names are different
            if (isset($_FILES[$pdf_key]) && $_FILES[$pdf_key]['error'] == 0) {
                $pdf_files[] = $_FILES[$pdf_key]; // Add other PDF files if they exist
            }
        }
    }

    $image_loc = $_FILES['Pimage']['tmp_name'];
    $image_name = $_FILES['Pimage']['name'];

    // Prepare upload directories for PDFs
    $pdf_des = [];
    foreach ($pdf_files as $pdf) {
        $destination = "Uplord/" . $pdf['name'];
        if (move_uploaded_file($pdf['tmp_name'], $destination)) {
            $pdf_des[] = $destination; // Add the destination path if upload is successful
        } else {
            echo "Error uploading file: " . $pdf['name'];
            exit;
        }
    }

    // Prepare image upload
    $img_des = "Uplord_image/" . $image_name;
    if (!move_uploaded_file($image_loc, $img_des)) {
        echo "Error uploading image.";
        exit;
    }

    // Insert Product
    $sql = "INSERT INTO studybookproducts ( Id,TName, PImage, P3price, P6price, P12price, Description, Subject, File, Years, Years1, Years2, Years3, Years4, Years5, Years6, Years7, Years8, Years9) 
    VALUES ('$product_id','$product_name', '$img_des', '$product_p3price', '$product_p6price', '$product_p12price', 
    '$product_description', '$product_subject', '" . implode(",", $pdf_des) . "', '" . implode("', '", $years) . "')";

    if (mysqli_query($con, $sql)) {
        echo "
        <script>
        alert('Record inserted successfully.');
        window.location.href='./uploadfile.php';
        </script>
        ";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
