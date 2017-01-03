<?php

require ("connection_db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data</title>
    <link rel="stylesheet" href="CSS/material.min.css">
    <script src="JS/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./CSS/css_properties.css">
    <link rel="stylesheet" href="./CSS/custom.css">
    <link rel="stylesheet" href="./CSS/font-awesome.min.css">
    <script src="./JS/jquery-3.1.1.min.js"></script>
    <script src="./JS/custom_script.js"></script>
</head>
<body class="custom_body">
<div class="mdl-layout mdl-js-layout">

    <header class="mdl-layout__header mdl-layout__header--scroll mdl-shadow--16dp">
        <div class="mdl-layout__header-row custom_header">
            <span class="mdl-logo"><img src="./images/logo.png" alt="Logo" width="80%"></span>
            <div class="mdl-layout-spacer"></div>
            <nav class="mdl-navigation">
                <a href="" class="mdl-navigation__link">User Manual</a>
                <a href="" class="mdl-navigation__link">ETA Comparison Tool</a>
                <a href="" class="mdl-navigation__link">Contact</a>
            </nav>
        </div>
    </header>

    <main class="centered_panel mdl-shadow--24dp border-radius--4 position--relative">

        <form id="myForm" name="frm" action="simulation.php" onsubmit="return validate();" method="post" target="_blank">

            <!-- General Section -->
            <div class="margin--8 border--1-solid-black border-radius--4 mdl-shadow--4dp inner_panel">

                <!-- Header Section -->
                <div class="margin--8">
                    <div class="display--inline-block">
                        <a href="#"  onclick="slidePanel('id_general_inputs'),changeArrow('arrow_down_g','arrow_up_g')">
                            <img id="arrow_down_g" src="images/icons/arrow_down.png" class="float-left arrow_down" width="16px" alt="">
                        </a>
                        <a href="#" onclick="slidePanel('id_general_inputs'),changeArrow('arrow_up_g','arrow_down_g')">
                            <img src="images/icons/arrow_up.png" id="arrow_up_g" class="float-right arrow_up" width="16px" alt="">
                        </a>
                    </div>
                    <span class="mdl-card__supporting-text"><b>General</b></span>
                </div>

                <!-- Inputs -->
                <div class="input_container margin--8" id="id_general_inputs">
                    <div class="margin--4">
                        <span class="mdl-card__supporting-text">Company Name</span>
                        <input class="float-right" type="text" size="60">
                    </div>
                    <div class="margin--4">
                        <span class="mdl-card__supporting-text">Engineer</span>
                        <input class="float-right" type="text" size="60">
                    </div>
                    <div class="margin--4">
                        <span class="mdl-card__supporting-text">Well</span>
                        <input class="float-right" type="text" size="60">
                    </div>
                    <div class="margin--4">
                        <span class="mdl-card__supporting-text">Field</span>
                        <input class="float-right" type="text" size="60">
                    </div>
                    <div class="margin--4">
                        <span class="mdl-card__supporting-text">Location</span>
                        <input class="float-right" type="text" size="60">
                    </div>
                </div>
            </div>

            <!-- Formation Section -->
            <div class="margin--8 border--1-solid-black border-radius--4 mdl-shadow--4dp inner_panel">

                <!-- Header Section -->
                <div class="margin--8">

                    <div class="display--inline-block">
                        <a href="#"  onclick="slidePanel('id_formation_inputs'),changeArrow('arrow_down_f','arrow_up_f')">
                            <img id="arrow_down_f" src="images/icons/arrow_down.png" class="float-left arrow_down" width="16px" alt="">
                        </a>
                        <a href="#" onclick="slidePanel('id_formation_inputs'),changeArrow('arrow_up_f','arrow_down_f')">
                            <img src="images/icons/arrow_up.png" id="arrow_up_f" class="float-right arrow_up" width="16px" alt="">
                        </a>
                    </div>

                    <span class="mdl-card__supporting-text"><b>Formation Data</b></span>

                </div>

                <!-- Inputs -->
                <div class="text-align--center margin--8"  id="id_formation_inputs">

                    <!-- Left Panel -->
                    <div class="input_container display--inline-block text-align--left float-left">

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Formation (<span style="color: #fe1624;">*</span>)</span>

                            <select class="float-right required_formation" name="formation" id="id_formation">
                                <option value="">Select</option>
                                <option value="Unconsolidated Sandstone">Unconsolidated Sandstone</option>
                                <option value="Semi Consolidated Sandstone">Semi Consolidated Sandstone</option>
                                <option value="Consolidated Sandstone">Consolidated Sandstone</option>
                                <option value="Sandstone - Limestone">Sandstone - Limestone</option>
                                <option value="Limestone Dolomite">Limestone Dolomite</option>
                                <option value="Dolomite Shale">Dolomite Shale</option>
                            </select>

                        </div>

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Completion Fluid (<span style="color: #fe1624;">*</span>)</span>

                            <select class="float-right required_formation" name="completion_fluid" id="id_completion_fluid" onchange="changeFluidWeight(this.value)">
                                <option value="">Select</option>
                                <option value="12">Completion Fluid</option>
                                <option value="8.338">Fresh Water</option>
                                <option value="9.625">Salt Water</option>
                                <option value="">Other</option>
                            </select>

                        </div>
                    </div>

                    <!-- Right Panel -->
                    <div class="input_container display--inline-block text-align--left">

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Fluid Weight (<span style="color: #fe1624;">*</span>)</span>

                            <input class="float-right required_formation" min="0" max="1000" type="number" step="any" id="id_fluid_weight">

                        </div>

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Borehole Diameter(<span style="color: #fe1624;">*</span>)</span>

                            <select onchange="loadOD(this.id,'id_casing_od',0)" class="float-right required_formation" name="borehole_diameter" size="" id="id_borehole_diameter">
                                <option value="">Select</option>
                                <?php
                                $query = "SELECT OD, VALUE FROM BOREHOLE_DIAMETER ORDER BY VALUE";
                                $res = mysqli_query($dbh, $query);
                                while( $row = mysqli_fetch_assoc($res) ){
                                    ?>
                                    <option value="<?php echo $row["VALUE"]; ?>"><?php echo $row["OD"]; ?></option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Overburden Gradient (<span style="color: #fe1624;">*</span>)</span>

                            <input class="float-right required_formation" min="0" max="1000" type="number" step="any">

                        </div>

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Depth to Bottom Shot (<span style="color: #fe1624;">*</span>)</span>

                            <input class="float-right required_formation" min="0" max="100000" type="number" step="any">

                        </div>

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Depth to Top Shot (<span style="color: #fe1624;">*</span>)</span>

                            <input class="float-right required_formation" min="0" max="100000" type="number" step="any">

                        </div>

                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Damage Zone (<span style="color: #fe1624;">*</span>)</span>

                            <input class="float-right required_formation" min="0" max="1000" type="number" step="any">

                        </div>
                    </div>
                </div>

            </div>

            <!-- Tubular Section -->
            <div class="margin--8 border--1-solid-black border-radius--4 mdl-shadow--4dp inner_panel">

                <!-- Header Section -->
                <div class="margin--8">
                    <div class="display--inline-block">
                        <a href="#"  onclick="slidePanel('id_well_inputs'),changeArrow('arrow_down_w','arrow_up_w')">
                            <img id="arrow_down_w" src="images/icons/arrow_down.png" class="float-left arrow_down" width="16px" alt="">
                        </a>
                        <a href="#" onclick="slidePanel('id_well_inputs'),changeArrow('arrow_up_w','arrow_down_w')">
                            <img src="images/icons/arrow_up.png" id="arrow_up_w" class="float-right arrow_up" width="16px" alt="">
                        </a>
                    </div>

                    <span class="mdl-card__supporting-text"><b>Well Tubulars</b></span>
                </div>

                <!-- Inputs -->
                <div class="text-align--center padding--8" id="id_well_inputs">
                    <!-- Casing Quantity -->
                    <div class="text-align--left margin--8">
                        <span >Casings(<span style="color: #fe1624;">*</span>)</span>
                        <select onchange="refreshCasings(this.value)" name="casing_quantity" id="id_casing_quantity">

                            <option value="">Select</option>

                            <option id="id_casings_value_1" selected value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                        </select>
                    </div>

                    <!-- Casing 1 Section -->
                    <div id="casing1_div" class="display--inline-block margin--8">

                        <span class="mdl-card__supporting-text"><b>Casing 1</b></span><br>

                        <div class="margin--8">

                            <div class="input_container display--inline-block text-align--left">

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Casing OD (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_1" name="casing_od" id="id_casing_od" onchange="loadWeight(this.value,'id_casing_weight')">

                                        <option value="">Select</option>

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Weight (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_1" name="casing_weight" id="id_casing_weight" onchange="loadOD('id_casing_od','id_casing2_od',this.value); loadPipe('id_casing_od',this.id,'id_casing_grade')">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Pipe Grade (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_1" name="casing_grade" id="id_casing_grade">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Sheath (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_1" name="casing_seath" id="id_casing_seath" onchange="casingSeathChange(this.value,'id_fluid_weight_input1','id_cement_input1')">

                                        <option value="">Select</option>
                                        <option value="Cement">Cement</option>
                                        <option value="Fluid">Fluid</option>

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Fluid Weight (<span style="color: #fe1624;">*</span>)</span>

                                    <input class="float-right required_casing_1" id="id_fluid_weight_input1" type="number" step="any" min="0" max="10000">

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Cement String (<span style="color: #fe1624;">*</span>)</span>

                                    <input  class="float-right required_casing_1" id="id_cement_input1" type="number" step="any" min="0" max="10000">

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Casing 2 Section -->
                    <div id="casing2_div" class="display--inline-block margin--8 casing_div">

                        <span class="mdl-card__supporting-text"><b>Casing 2</b></span><br>

                        <div class="margin--8">

                            <div class="input_container display--inline-block text-align--left">

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Casing OD (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_2" name="casing2_od" id="id_casing2_od" onchange="loadWeight(this.value,'id_casing2_weight')">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Weight (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_2" name="casing2_weight" id="id_casing2_weight" onchange="loadOD('id_casing2_od','id_casing3_od',this.value);loadPipe('id_casing2_od',this.id,'id_casing2_grade')">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Pipe Grade (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_2" name="casing2_grade" id="id_casing2_grade">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Sheath (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_2" name="casing2_seath" id="id_casing2_seath" onchange="casingSeathChange(this.value,'id_fluid_weight_input2','id_cement_input2')">

                                        <option value="">Select</option>
                                        <option value="Cement">Cement</option>
                                        <option value="Fluid">Fluid</option>

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Fluid Weight (<span style="color: #fe1624;">*</span>)</span>

                                    <input class="float-right required_casing_2"  id="id_fluid_weight_input2" type="number" step="any" min="0" max="10000">

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Cement String (<span style="color: #fe1624;">*</span>)</span>

                                    <input  class="float-right required_casing_2" id="id_cement_input2" type="number" step="any" min="0" max="10000">

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Casing 3 Section -->
                    <div id="casing3_div" class="display--inline-block margin--8 casing_div">

                        <span class="mdl-card__supporting-text"><b>Casing 3</b></span><br>

                        <div class="margin--8">

                            <div class="input_container display--inline-block text-align--left">

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Casing OD (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_3" name="casing3_od" id="id_casing3_od" onchange="loadWeight(this.value,'id_casing3_weight')">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Weight(<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_3" name="casing3_weight" id="id_casing3_weight" onchange="loadPipe('id_casing3_od',this.id,'id_casing3_grade')">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Pipe Grade (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right" name="casing3_grade" id="id_casing3_grade">

                                        <option value="">Select</option>
                                        <!-- Traer tabla con ajax -->

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Sheath (<span style="color: #fe1624;">*</span>)</span>

                                    <select class="float-right required_casing_3" name="casing3_seath" id="id_casing3_seath" onchange="casingSeathChange(this.value,'id_fluid_weight_input3','id_cement_input3')">

                                        <option value="">Select</option>
                                        <option value="Cement">Cement</option>
                                        <option value="Fluid">Fluid</option>

                                    </select>

                                </div>

                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Fluid Weight (<span style="color: #fe1624;">*</span>)</span>

                                    <input class="float-right required_casing_3" type="number" step="any" min="0" max="10000"  id="id_fluid_weight_input3">

                                </div>
                                <div class="margin--4">

                                    <span class="mdl-card__supporting-text">Cement String (<span style="color: #fe1624;">*</span>)</span>

                                    <input  class="float-right required_casing_3" type="number" step="any" min="0" max="10000" id="id_cement_input3">

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Gun Section -->
            <div class="margin--8 border--1-solid-black border-radius--4 mdl-shadow--4dp inner_panel">

                <!-- Header Section -->
                <div class="margin--8">
                    <div class="display--inline-block">
                        <a href="#"  onclick="slidePanel('id_gun_inputs'),changeArrow('arrow_down_gun','arrow_up_gun')">
                            <img id="arrow_down_gun" src="images/icons/arrow_down.png" class="float-left arrow_down" width="16px" alt="">
                        </a>
                        <a href="#" onclick="slidePanel('id_gun_inputs'),changeArrow('arrow_up_gun','arrow_down_gun')">
                            <img src="images/icons/arrow_up.png" id="arrow_up_gun" class="float-right arrow_up" width="16px" alt="">
                        </a>
                    </div>
                    <span class="mdl-card__supporting-text"><b>Gun Data</b></span>
                </div>

                <!-- Input Section -->
                <div class="" id="id_gun_inputs">

                    <div class="display--inline-block">

                        <!-- Company Select -->
                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">API Certified Company (<span style="color: #fe1624;">*</span>)</span>

                            <select class="float-right required_gun" name="api_company" size="" id="id_api_company" onchange="">

                                <option value="">Select</option>
                                <?php
                                $query = "SELECT DISTINCT GCOMPANYS FROM GUNS WHERE MODO='SI' ORDER BY GCOMPANYS";
                                $res = mysqli_query($dbh, $query);
                                while( $row = mysqli_fetch_row($res) ) {
                                    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                                }
                                ?>

                            </select>
                        </div>

                        <div class="display--inline-block mdl-cell--6-col">

                            <div class="margin--4">

                                <span class="mdl-card__supporting-text"><b>Charge Type (<span style="color: #fe1624;">*</span>)</b></span>

                                <span class="mdl-card__supporting-text">DP</span>
                                <input type="radio" class="required_gun_ctype" name="ctype" value="DP" onchange="loadGun()">

                                <span class="mdl-card__supporting-text">BH</span>
                                <input type="radio" class="required_gun_ctype" name="ctype" value="BH" onchange="loadGun()">

                            </div>

                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Gun Size (<span style="color: #fe1624;">*</span>)</span>

                                <select class="float-right required_gun" name="gun_size" size="" id="id_gun_size" onchange="loadShotDensity()">

                                    <option value="">Select</option>
                                    <!-- Traer base con ajax -->

                                </select>

                            </div>

                            <!-- Shot Density Select -->
                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Shot Density (<span style="color: #fe1624;">*</span>)</span>

                                <select class="required_gun float-right" name="shot_density" size="" id="id_shot_density" onchange="loadGunPhase()">

                                    <option value="">Select</option>
                                    <!-- Traer base con ajax -->

                                </select>

                            </div>

                            <!-- Gun Phase Select -->
                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Gun Phase (<span style="color: #fe1624;">*</span>)</span>

                                <select class="float-right required_gun" name="gun_phase" size="" id="id_gun_phase" onchange="loadChargeGram()">

                                    <option value="">Select</option>
                                    <!-- Traer base con ajax -->

                                </select>

                            </div>


                            <!-- Charge Gram Weight Select -->
                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Charge Gram Weight (<span style="color: #fe1624;">*</span>)</span>

                                <select class="float-right required_gun" name="charge_gram_weight" size="" id="id_charge_gram_weight" onchange="loadCPN()">

                                    <option value="">Select</option>
                                    <!-- Traer base con ajax -->

                                </select>

                            </div>

                            <!-- Charge Part Number Select -->
                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Charge Part Number (<span style="color: #fe1624;">*</span>)</span>

                                <select class="float-right required_gun" name="charge_part_number" size="" id="id_cpn">

                                    <option value="">Select</option>
                                    <!-- Traer base con ajax -->

                                </select>

                            </div>

                            <!-- Explosive Select -->
                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Explosive (<span style="color: #fe1624;">*</span>)</span>

                                <select class="float-right required_gun" name="explosive" size="" id="id_explosive">

                                    <option value="">Select</option>
                                    <!-- Traer base con ajax -->

                                </select>
                            </div>

                            <!-- Gun Position Select -->
                            <div class="margin--4">

                                <span class="mdl-card__supporting-text">Position (<span style="color: #fe1624;">*</span>)</span>

                                <select class="float-right required_gun" name="position" size="" id="id_position">

                                    <option value="">Select</option>

                                    <option value="Eccentered">Eccentered</option>

                                    <option value="Centered">Centered</option>

                                </select>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Calculation Section -->
            <div class="margin--8 border--1-solid-black border-radius--4 mdl-shadow--4dp inner_panel">

                <!-- Header Section -->
                <div class="margin--8">

                    <div class="display--inline-block">
                        <a href="#"  onclick="slidePanel('id_calculation_inputs'),changeArrow('arrow_down_c','arrow_up_c')">
                            <img id="arrow_down_c" src="images/icons/arrow_down.png" class="float-left arrow_down" width="16px" alt="">
                        </a>
                        <a href="#" onclick="slidePanel('id_calculation_inputs'),changeArrow('arrow_up_c','arrow_down_c')">
                            <img src="images/icons/arrow_up.png" id="arrow_up_c" class="float-right arrow_up" width="16px" alt="">
                        </a>
                    </div>

                    <span class="mdl-card__supporting-text"><b>Calculation Method</b></span>
                </div>

                <!-- Input Section -->
                <div class="text-align--center" id="id_calculation_inputs">

                    <div class="input_container display--inline-block text-align--left">

                        <!-- Formation Compressive Strength -->
                        <div class="margin--4">

                            <span class="mdl-card__supporting-text">Formation Compressive Strength (<span style="color: #fe1624;">*</span>)</span>

                            <input type="number" step="any" onchange="disableInput(this,'id_porosity_input')" id="id_compressive_input" class="required_calculation" min="0" max="10000">

                        </div>

                        <!-- Formation Porosity -->
                        <div class="margin--4">
                            <span class="mdl-card__supporting-text">Formation Porosity (<span style="color: #fe1624;">*</span>)</span>
                            <input class="float-right required_calculation" onchange="disableInput(this,'id_compressive_input')" id="id_porosity_input" type="number" step="any" min="0" max="10000">
                        </div>

                    </div>

                </div>
            </div>

            <!-- Submit Button -->
            <div class="submit--btn-div inner_panel">
                <span class="required_info">(<span style="color: #fe1624;">*</span>): Required Fields</span>
                <input type="submit" class="myButton mdl-shadow--8dp" value="Calculate">
            </div>

        </form>

    </main>

    <footer class="mdl-mini-footer fixed-footer">
        <div class="mdl-mini-footer__left-section">
            <div class="mdl-logo">Title</div>
            <ul class="mdl-mini-footer__link-list">
                <li><a href="#">Help</a></li>
                <li><a href="#">Privacy & Terms</a></li>
            </ul>
        </div>
    </footer>

</div>

<script>
    //Global Variables
    var req;

    var casing_cuantity = 1;
    var smaller_od_id = "id_casing_od"
    var company_name;
    var gun_od;
    var shot_density;
    var charge_type;
    var gun_phase;
    var charge_gram;

    $(document).ready(function(){
        $(".arrow_down").hide();

        $(".casing_div").fadeToggle("fast");

        $("#id_casings_value_1").selected = true;
    });

    /**
     *  Method used to change the visibility of the
     *  casings inputs when the quantity is selected
     *  */
    function refreshCasings(casing_number) {
        switch (casing_number) {
            case "1":
                casing_cuantity = 1;
                smaller_od_id = "id_casing_od";
                disableCInputs(1);
                $("#casing1_div").fadeIn(200);
                $("#casing2_div").fadeOut(200);
                $("#casing3_div").fadeOut(200);
                break;

            case "2":
                casing_cuantity = 2;
                smaller_od_id = "id_casing2_od";
                disableCInputs(2);
                $("#casing1_div").fadeIn(200);
                $("#casing2_div").fadeIn(200);
                $("#casing3_div").fadeOut(200);
                break;

            case "3":
                casing_cuantity = 3;
                smaller_od_id = "id_casing3_od";
                disableCInputs(3);
                $("#casing1_div").fadeIn(200);
                $("#casing2_div").fadeIn(200);
                $("#casing3_div").fadeIn(200);
                break;

            default:
                casing_cuantity = 0
                disableCInputs(0);
                $("#casing1_div").fadeOut(200);
                $("#casing2_div").fadeOut(200);
                $("#casing3_div").fadeOut(200);
                break;
        }
    }

    function disableCInputs(selected) {
        switch (selected){
            case 1:
                $("#casing1_div :input").prop("disabled", false);
                $("#casing2_div :input").prop("disabled", true);
                $("#casing3_div :input").prop("disabled", true);
                break;

            case 2:
                $("#casing1_div :input").prop("disabled", false);
                $("#casing2_div :input").prop("disabled", false);
                $("#casing3_div :input").prop("disabled", true);
                break;

            case 3:
                $("#casing1_div :input").prop("disabled", false);
                $("#casing2_div :input").prop("disabled", false);
                $("#casing3_div :input").prop("disabled", false);
                break;
            case 0:
                $("#casing1_div :input").prop("disabled", true);
                $("#casing2_div :input").prop("disabled", true);
                $("#casing3_div :input").prop("disabled", true);
                break;
        }

    }

    /**
     *  Method used to change the value of the
     *  Fluid Weight input when the completion fluid is selected
     *  */
    function changeFluidWeight(weight){
        $("#id_fluid_weight").val(weight);
    }

    /** Method to add the panel slide when the arrows are clicked */
    function slidePanel(panel_id) {
        $("#"+panel_id).slideToggle(350);
    }

    /** Method to change the arrow image alternating down and up */
    function changeArrow(arrow_clicked_id, arrow_show_id) {
        $("#"+arrow_clicked_id).fadeToggle(function () {
            $("#"+arrow_show_id).fadeToggle();
        });

    }

    /** Validating Casings Inputs */
    function checkCasings() {
        var quantity = $("#id_casing_quantity").val();

        var booleanCasings = true;

        switch (quantity){
            case "1":
                booleanCasings = checkRequired('required_casing_1');
                break;

            case "2":
                var casing1 = checkRequired('required_casing_1');
                var casing2 = checkRequired('required_casing_2');
                booleanCasings = casing1 && casing2;
                break;

            case "3":
                var casing1 = checkRequired('required_casing_1');
                var casing2 = checkRequired('required_casing_2');
                var casing2 = checkRequired('required_casing_3');
                booleanCasings = casing1 && casing2;
                break;

            default:
                alert("Select Casing Quantity");
                $("#id_casing_quantity").focus();
                booleanCasings = false;
                break;
        }
        return booleanCasings;
    }

    /** Validating Gun Type Radio Buttons **/
    function checkGunType() {
        var array = $('.required_gun_ctype');
        var count = 0;
        var length = array.length
        for (var a = 0 ; a<length ; a++){
            if (array[a].checked){
                count++;
            }
        }

        if (length != count){
            alert("Select One Type");
            array[0].focus();
            return false;
        }
        else {
            return true;
        }
    }

    function disableInput(source, element_id) {
        if (source.value == ""){
            document.getElementById(element_id).disabled = false;
        }
        else {
            document.getElementById(element_id).disabled = true;
        }
    }

    function checkCalculation() {
        checkRequired('required_calculation')
    }

    /** Validate Form */
    function validate() {

        var formation_boolean = checkRequired('required_formation');
        var casing_boolean = checkCasings();
        var gun_boolean = checkRequired('required_gun');
        var gun_type_boolean = checkGunType();
        var calculation_boolean = checkCalculation();

        return (formation_boolean && casing_boolean && gun_boolean && gun_type_boolean && calculation_boolean);
    }

    function checkRequired(classNameToCheck){

        var result_correct = true;

        var array = $("."+classNameToCheck);

        for (var a = 0 ; a < array.length ; a++){
            var value = array[a].value;

            if (value == "" || value == null || value == "Select"){
                if (array[a].disabled == false){
                    array[a].style.border = "solid red 1px";
                    result_correct = false;
                }
            }
            else {
                array[a].style.border = "none";
            }

        }
        return result_correct;
    }

    function loadOD(id_outer_diameter, id_to_change, weight){
        var out_d = document.getElementById(id_outer_diameter).value;

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            req = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            req = new ActiveXObject("Microsoft.XMLHTTP");
        }
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                document.getElementById(id_to_change).innerHTML += this.responseText;
            }
        };
        req.open('POST','./ajax/od_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("outer_value="+out_d+"&outer_weight="+weight);



    }

    function loadWeight(diameter, id_to_change) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            req = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            req = new ActiveXObject("Microsoft.XMLHTTP");
        }

        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(id_to_change).innerHTML += this.responseText;
            }
        };

        req.open('POST','./ajax/weight_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("diameter="+diameter.toString());

    }

    function loadPipe(id_od, id_weight, id_result){
        req = new XMLHttpRequest();

        var od = $("#"+id_od).val();
        var wght = $("#"+id_weight).val();

        console.log("od:" +od);
        console.log("weight:"+wght);

        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(id_result).innerHTML += this.responseText;
            }
        };
        req.open('POST', './ajax/pipe_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send('weight='+wght+"&od="+od);


    }

    function casingSeathChange(selection,id_fluid,id_cement) {
        if (selection == "Cement"){
            $("#"+id_fluid).prop("disabled",true);
            $("#"+id_cement).prop("disabled",false);
        }
        else if (selection == "Fluid"){
            $("#"+id_cement).prop("disabled",true);
            $("#"+id_fluid).prop("disabled",false);
        }
    }

    function loadGun() {
        company_name = $("#id_api_company").val();
        charge_type = $('input[name=ctype]:checked', '#myForm').val()
        var smaller_od = $("#"+smaller_od_id).val();

        if ((!casing_cuantity == 0) && (smaller_od != null)){
            req = new XMLHttpRequest();
            req.open('POST','./ajax/gunSize_query.php',true);
            req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Response Gun: "+this.responseText);
                    document.getElementById("id_gun_size").innerHTML += this.responseText;
                }
            };
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send('company='+company_name+"&type="+charge_type+"&od="+smaller_od);

        }
    }

    function loadShotDensity() {
        gun_od = $("#id_gun_size").val();

        req = new XMLHttpRequest();
        req.open('POST','./ajax/sdensity_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Response sdensity: "+this.responseText);
                document.getElementById("id_shot_density").innerHTML += this.responseText;
            }
        };
        req.send("g_od="+gun_od+"&company="+company_name+"&ctype="+charge_type);
    }

    function loadGunPhase() {
        shot_density = $("#id_shot_density").val();

        req = new XMLHttpRequest();
        req.open('POST','./ajax/gunphase_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("id_gun_phase").innerHTML += this.responseText;
            }
        };
        req.send("g_od="+gun_od+"&company="+company_name+"&ctype="+charge_type+"&s_dens="+shot_density);
    }

    function loadChargeGram() {
        gun_phase = $('#id_gun_phase').val();

        req = new XMLHttpRequest();
        req.open('POST','./ajax/charge_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("id_charge_gram_weight").innerHTML += this.responseText;
            }
        };
        req.send("g_od="+gun_od+"&company="+company_name+"&ctype="+charge_type+"&s_dens="+shot_density+"&g_phase="+gun_phase);
    }

    function loadCPN() {
        charge_gram = $('#id_charge_gram_weight').val();

        req = new XMLHttpRequest();
        req.open('POST','./ajax/cpn_query.php',true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("cpn: "+this.responseText);
                document.getElementById("id_cpn").innerHTML += this.responseText;
            }
        };
        req.send("g_od="+gun_od+"&company="+company_name+"&ctype="+charge_type+"&s_dens="+shot_density+"&g_phase="+gun_phase+"&c_gram="+charge_gram);
    }

</script>
</body>
</html>