<?php
require_once "actions/db.php";
require_once "utils.php";
require_once "controllers/credentials.php";
requireCredentials();

$conn = getConn();
$stmt = $conn->prepare("SELECT fname, mname, lname, email, contact_num, address, citizenship, civil_status, rs_status, occupation, med_cond, birthdate, sex, mother_fname, mother_mname, mother_lname, mother_contact, mother_occupation, father_fname, father_mname, father_lname, father_contact, father_occupation, guardian_fname, guardian_mname, guardian_lname, guardian_contact, guardian_occupation, grade_level, first_choice, second_choice, prev_school, img_profile_filename, img_payment_filename, img_birthcert_filename, img_form137_filename, img_form138_filename, img_goodmoral_filename, img_brgyclear_filename, img_transfercert_filename  FROM student_information WHERE user_id = ?");
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$stmt->bind_result($db_fname, $db_mname, $db_lname, $db_email, $db_contact_num, $db_address, $db_citizenship, $db_civil_status, $db_rs_status, $db_occupation, $db_med_cond, $db_birthdate, $db_sex, $db_mother_fname, $db_mother_mname, $db_mother_lname, $db_mother_contact, $db_mother_occupation, $db_father_fname, $db_father_mname, $db_father_lname, $db_father_contact, $db_father_occupation, $db_guardian_fname, $db_guardian_mname, $db_guardian_lname, $db_guardian_contact, $db_guardian_occupation, $db_grade_level, $db_first_choice, $db_second_choice, $db_prev_school, $db_img_profile_filename, $db_img_payment_filename, $db_img_birthcert_filename, $db_img_form137_filename, $db_img_form138_filename, $db_img_goodmoral_filename, $db_img_brgyclear_filename, $db_img_transfercert_filename);
$stmt->fetch();

$stmt->close();
$conn->close();
?>

<div class="card text-primary bg-light p-3">
    <div class="card-body">
        <h4 class="card-title">Informatics Admission Form</h4>
        <form action="actions/submit_application_action.php" method="post" enctype="multipart/form-data">
            <h6>Student Name</h6>
            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="name-first" id="name-first" class="form-control" value="<?= $db_fname ?>" />
                    <small>First Name</small>
                    <small id="name-first-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="name-middle" id="name-middle" class="form-control" value="<?= $db_mname ?>" />
                    <small>Middle Name</small>
                    <small id="name-middle-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="name-last" id="name-last" class="form-control" value="<?= $db_lname ?>" />
                    <small>Last Name</small>
                    <small id="name-last-err" class="text-danger"></small>
                </div>
            </div>

            <div class="row g-3">
                <div class="mb-3 col-12 col-md-6">
                    <input type="text" name="email" id="email" class="form-control" value="<?= $db_email ?>" />
                    <small>Email Address</small>
                    <small id="email-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <input type="text" name="contact-num" id="contact-num" class="form-control" value="<?= $db_contact_num ?>" />
                    <small>Contact Number</small>
                    <small id="contact-num-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12">
                    <input type="text" name="address" id="address" class="form-control" value="<?= $db_address ?>" />
                    <small>Present Address</small>
                    <small id="address-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <input type="text" name="citizenship" id="citizenship" class="form-control" value="<?= $db_citizenship ?>" />
                    <small>Citizenship</small>
                    <small id="citizenship-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <input type="text" name="civil-status" id="civil-status" class="form-control" value="<?= $db_civil_status ?>" />
                    <small>Civil Status</small>
                    <small id="civil-status-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <input type="text" name="rs-status" id="rs-status" class="form-control" value="<?= $db_rs_status ?>" />
                    <small>Relationship Status</small>
                    <small id="rs-status-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <input type="text" name="occupation" id="occupation" class="form-control" value="<?= $db_occupation ?>" />
                    <small>Occupation</small>
                    <small id="occupation-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12">
                    <h6>Does the student have any medical conditions?</h6>
                    <textarea class="form-control" name="med-condition" id="medical-condition" rows="3"><?= $db_med_cond ?></textarea>
                </div>
            </div>

            <div class="row g-3">
                <div class="mb-3 col-12 col-md-6">
                    <h6>Date of Birth (YYYY-MM-DD)</h6>
                    <input class="form-control" type="text" id="datepicker" name="birthdate" value="<?= $db_birthdate ?>" />
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <h6>Sex assigned at Birth</h6>
                    <select class="form-select" name="sex">
                        <option <?= $db_sex == "male" ? "selected" : "" ?> value="male">Male</option>
                        <option <?= $db_sex == "female" ? "selected" : "" ?> value="female">Female</option>
                    </select>
                </div>
            </div>

            <h6 class="mt-4">Mother's Information</h6>
            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="mother-name-first" id="mother-name-first" class="form-control" value="<?= $db_mother_fname ?>" />
                    <small>Mother's First Name</small>
                    <small id="mother-name-first-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="mother-name-middle" id="mother-name-middle" class="form-control" value="<?= $db_mother_mname ?>" />
                    <small>Mother's Middle Name</small>
                    <small id="mother-name-middle-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="mother-name-last" id="mother-name-last" class="form-control" value="<?= $db_mother_lname ?>" />
                    <small>Mother's Name</small>
                    <small id="mother-name-last-err" class="text-danger"></small>
                </div>
            </div>
            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="mother-contact" id="mother-contact" class="form-control" value="<?= $db_mother_contact ?>" />
                    <small>Mother's Contact Number</small>
                    <small id="mother-contact-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="mother-occupation" id="mother-occupation" class="form-control" value="<?= $db_mother_occupation ?>" />
                    <small>Mother's Occupation</small>
                    <small id="mother-occupation-err" class="text-danger"></small>
                </div>
            </div>

            <h6 class="mt-4">Father's Information</h6>
            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="father-name-first" id="father-name-first" class="form-control" value="<?= $db_father_occupation ?>" />
                    <small>Father's First Name</small>
                    <small id="father-name-first-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="father-name-middle" id="father-name-middle" class="form-control" value="<?= $db_father_mname ?>" />
                    <small>Father's Middle Name</small>
                    <small id="father-name-middle-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="father-name-last" id="father-name-last" class="form-control" value="<?= $db_father_lname ?>" />
                    <small>Father's Name</small>
                    <small id="father-name-last-err" class="text-danger"></small>
                </div>
            </div>
            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="father-contact" id="father-contact" class="form-control" value="<?= $db_father_contact ?>" />
                    <small>Father's Contact Number</small>
                    <small id="father-contact-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="father-occupation" id="father-occupation" class="form-control" value="<?= $db_father_occupation ?>" />
                    <small>Father's Occupation</small>
                    <small id="father-occupation-err" class="text-danger"></small>
                </div>
            </div>

            <h6 class="mt-4">Guardian's Information</h6>
            <div class="row g-3" id="guardian-info">
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="guardian-name-first" id="guardian-name-first" class="form-control" value="<?= $db_guardian_fname ?>" />
                    <small>Guardian's First Name</small>
                    <small id="guardian-name-first-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="guardian-name-middle" id="guardian-name-middle" class="form-control" value="<?= $db_guardian_mname ?>" />
                    <small>Guardian's Middle Name</small>
                    <small id="guardian-name-middle-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="guardian-name-last" id="guardian-name-last" class="form-control" value="<?= $db_guardian_lname ?>" />
                    <small>Guardian's Name</small>
                    <small id="guardian-name-last-err" class="text-danger"></small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <input type="text" name="guardian-contact" id="guardian-contact" class="form-control" value="<?= $db_guardian_contact ?>" />
                    <small>Guardian's Contact Number</small>
                    <small id="guardian-contact-err" class="text-danger"></small>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="mb-3 col-12 col-md-4">
                    <h6>Grade level applying for</h6>
                    <select class="form-select" name="grade-level">
                        <option selected value="<?= $db_grade_level ?>"></option>
                        <option value="Grade11">Grade 11</option>
                        <option value="Grade12">Grade 12</option>
                        <option value="FIRSTYR">First year College</option>
                        <option value="SECONDYR">Second year College</option>
                        <option value="THIRDYR">Third year College</option>
                        <option value="FOURTHYR">Fourth year College</option>
                    </select>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Preferred Course/Strand</h6>
                    <select class="form-select" name="choice-1">
                        <option selected value="<?= $db_first_choice ?>"></option>
                        <option value="HUMMS">SHS: HUMMS</option>
                        <option value="ICT-Animation">SHS: ICT-Animation</option>
                        <option value="ICT-Programming">SHS: ICT-Programming</option>
                        <option value="GAS">SHS: GAS</option>
                        <option value="ABM">College: ABM</option>
                        <option value="BSIT">College: BSIT</option>
                        <option value="BSBA">College: BSBA</option>
                        <option value="BSCS">College: BSCS</option>
                    </select>
                    <small>First choce</small>
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>&nbsp;</h6>
                    <select class="form-select" name="choice-2">
                        <option selected value="<?= $db_second_choice ?>"></option>
                        <option value="HUMMS">SHS: HUMMS</option>
                        <option value="ICT-Animation">SHS: ICT-Animation</option>
                        <option value="ICT-Programming">SHS: ICT-Programming</option>
                        <option value="GAS">SHS: GAS</option>
                        <option value="ABM">College: ABM</option>
                        <option value="BSIT">College: BSIT</option>
                        <option value="BSBA">College: BSBA</option>
                        <option value="BSCS">College: BSCS</option>
                    </select>
                    <small>Second Choice</small>
                </div>
            </div>

            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <h6>Previous School</h6>
                    <select class="form-select collapse show" name="prev-school-dropdown" id="prev-school-collapse" aria-expanded="true">
                        <option selected value="<?= $db_prev_school ?>"></option>
                        <option value="Anima Christi Center for Learning and Human Development">Anima Christi Center for Learning and Human Development</option>
                        <option value="APEC">APEC</option>
                        <option value="Bay View Academy">Bay View Academy</option>
                        <option value="Christ Baptist Academy">Christ Baptist Academy</option>
                        <option value="Christ the King School of Muntinlupa">Christ the King School of Muntinlupa</option>
                        <option value="Christ the Living Intercessor Christian School">Christ the Living Intercessor Christian School</option>
                        <option value="Colegio de Muntinlupa">Colegio de Muntinlupa</option>
                        <option value="Colegio de Nuestra Señora de Guadalupe">Colegio de Nuestra Señora de Guadalupe</option>
                        <option value="Cupang Senior High School">Cupang Senior High School</option>
                        <option value="De La Salle Zobel School">De La Salle Zobel School</option>
                        <option value="Divine Mercy School">Divine Mercy School</option>
                        <option value="Emmanuel John Institute of Science And Technology, Inc.">Emmanuel John Institute of Science And Technology, Inc.</option>
                        <option value="Far Eastern University Alabang">Far Eastern University Alabang</option>
                        <option value="Facilities Management College">Facilities Management College</option>
                        <option value="Holy Queen of La Salette School">Holy Queen of La Salette School</option>
                        <option value="Infant Jesus Montessori School of Muntinlupa - Parkhomes">Infant Jesus Montessori School of Muntinlupa - Parkhomes</option>
                        <option value="Kennedy International School of Business and Languages">Kennedy International School of Business and Languages</option>
                        <option value="Lakewood School of Alabang">Lakewood School of Alabang</option>
                        <option value="Le Sainte School">Le Sainte School</option>
                        <option value="Liceo de Alabang, Inc.">Liceo de Alabang, Inc.</option>
                        <option value="Liceo de Piccolo Santo">Liceo de Piccolo Santo</option>
                        <option value="Living Light Academy">Living Light Academy</option>
                        <option value="Lombosco Academy Foundation, Inc.">Lombosco Academy Foundation, Inc.</option>
                        <option value="Lyceum of Alabang INC.">Lyceum of Alabang INC.</option>
                        <option value="Maria Ferarri School">Maria Ferarri School</option>
                        <option value="Maranatha Christian Academy - Bayanan">Maranatha Christian Academy - Bayanan</option>
                        <option value="Mary Cause of our Joy Catholic School">Mary Cause of our Joy Catholic School</option>
                        <option value="Mary, Mother of God Parochial School">Mary, Mother of God Parochial School</option>
                        <option value="MBC-Sinai School">MBC-Sinai School</option>
                        <option value="Miraculous Medal School">Miraculous Medal School</option>
                        <option value="MIT International School">MIT International School</option>
                        <option value="Muntinlupa Business High School">Muntinlupa Business High School</option>
                        <option value="Muntinlupa Cosmopolitan School">Muntinlupa Cosmopolitan School</option>
                        <option value="Muntinlupa Institute of Technology (MIT)">Muntinlupa Institute of Technology (MIT)</option>
                        <option value="Muntinlupa National High School">Muntinlupa National High School</option>
                        <option value="Muntinlupa Science High School">Muntinlupa Science High School</option>
                        <option value="Our Lady of The Abandoned Catholic School">Our Lady of The Abandoned Catholic School</option>
                        <option value="Our Lady of the Lake School">Our Lady of the Lake School</option>
                        <option value="Pamantasan ng Lungsod ng Muntinlupa (PLMun)">Pamantasan ng Lungsod ng Muntinlupa (PLMun)</option>
                        <option value="PAREF Ridgefield School">PAREF Ridgefield School</option>
                        <option value="PAREF Rosemont School">PAREF Rosemont School</option>
                        <option value="PAREF Southridge School">PAREF Southridge School</option>
                        <option value="Pedro E. Diaz High School">Pedro E. Diaz High School</option>
                        <option value="Ridgeview Academy">Ridgeview Academy</option>
                        <option value="Sacred Heart Institute">Sacred Heart Institute</option>
                        <option value="Santo Niño School of Muntinlupa">Santo Niño School of Muntinlupa</option>
                        <option value="Servite School, Inc.">Servite School, Inc.</option>
                        <option value="Soldier's Hills Elementary School">Soldier's Hills Elementary School</option>
                        <option value="South Crest School">South Crest School</option>
                        <option value="Southernside Montessori School">Southernside Montessori School</option>
                        <option value="Spring Christian School">Spring Christian School</option>
                        <option value="STI College (Alabang Branch)">STI College (Alabang Branch)</option>
                        <option value="Sto. Domingo Pascual Academy, Inc.">Sto. Domingo Pascual Academy, Inc.</option>
                        <option value="Sunshine Christian School of Muntinlupa">Sunshine Christian School of Muntinlupa</option>
                        <option value="Theresiana de Montealegre Dame School">Theresiana de Montealegre Dame School</option>
                        <option value="The Birthright School of Muntinlupa">The Birthright School of Muntinlupa</option>
                        <option value="Tunasan National High School">Tunasan National High School</option>
                    </select>
                    <div class="collapse" id="prev-school-collapse">
                        <input type="text" name="prev-school-input" class="form-control" />
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $db_prev_school ?>" id="prev-school-checkbox" data-bs-toggle="collapse" data-bs-target="#prev-school-collapse">
                        <label class="form-check-label" for="prev-school-checkbox">
                            Outside of Muntinlupa
                        </label>
                    </div>
                </div>
            </div>

            <h6 class="mt-4">Images</h6>
            <div class="row g-3">
                <div class="mb-3 col-12 col-md-4">
                    <h6>1x1 Photo</h6>
                    <small><?= $db_img_profile_filename !== null ? $db_img_profile_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-profile" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Proof of payment</h6>
                    <small><?= $db_img_payment_filename !== null ? $db_img_payment_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-payment" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Birth Certificate</h6>
                    <small><?= $db_img_birthcert_filename !== null ? $db_img_birthcert_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-birthcert" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Form-137</h6>
                    <small><?= $db_img_form137_filename !== null ? $db_img_form137_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-form137" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Form-138</h6>
                    <small><?= $db_img_form138_filename !== null ? $db_img_form138_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-form138" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Good Moral</h6>
                    <small><?= $db_img_goodmoral_filename !== null ? $db_img_goodmoral_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-goodmoral" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-4">
                    <h6>Baranggay Clearance</h6>
                    <small><?= $db_img_brgyclear_filename !== null ? $db_img_brgyclear_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-brgyclearance" accept="image/*">
                </div>
                <div class="mb-3 col-12 col-md-8">
                    <h6>Previous School Transfer Certificate (if applicable)</h6>
                    <small><?= $db_img_transfercert_filename !== null ? $db_img_transfercert_filename : "no image uploaded"; ?></small>
                    <input class="form-control" type="file" name="img-transfercert" accept="image/*">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Initialize Datepicker -->
<script>
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-16y',
        });
    });
</script>