@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <!-- Bootstrap Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Residence Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('residence.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter first name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="middleName" class="form-label">Middle Name (if applicable) </label>
                                <input type="text" name="middle_name" class="form-control" id="middleName" placeholder="Enter middle name">
                            </div>
                            <div class="col-md-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="suffix" class="form-label">Suffix</label>
                                <select name="suffix" class="form-select" id="suffix">
                                    <option disabled selected value="">select suffix (if applicale) </option>
                                    <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II (The Second)</option>
                                    <option value="III">III (The Third)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="generatedEmail" class="form-label">Generated Email</label>
                                <input type="text" name="email" class="form-control" id="generatedEmail" placeholder="Generated email" readonly>
                            </div>
                        </div>
                        

                       
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="sex" class="form-label">Sex</label>
                                <select name="sex" class="form-select" id="sex" required>
                                    <option disabled selected value=""> Select your sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" id="dob" required>
                            </div>
                            <div class="col">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" id="age" placeholder="Enter your age" min="0" readonly required>
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="civilStatus" class="form-label">Civil Status</label>
                                <select name="civil_status" class="form-select" id="civilStatus" required>
                                    <option disabled selected value="">Select civil status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="purok" class="form-label">Purok</label>
                                 <select name="purok" class="form-control" id="purok" placeholder="Enter Purok" required>
                                    <option disabled selected value="">Select Purok</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                 </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="currentAddress" class="form-label">Current Address</label>
                                <input type="text" name="address" class="form-control" id="currentAddress" placeholder="Enter current address" required>
                            </div>
                            <div class="col">
                                <label for="placeOfBirth" class="form-label">Place of Birth</label>
                                <input type="text" name="place_of_birth" class="form-control" id="placeOfBirth" placeholder="Enter place of birth">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="educationalLevel" class="form-label">Educational Level</label>
                                <select name="educational_level" class="form-select" id="educationalLevel" required>
                                    <option disabled selected value="">Choose Educational Level</option>
                                    <option value="elementary_level">Elementary Level</option>
                                    <option value="elementary_graduate">Elementary Graduate</option>
                                    <option value="highschool_level">Highschool Levle</option>
                                    <option value="highschool_graduate">Highschool Graduate</option>
                                    <option value="college_level">College Level</option>
                                    <option value="college_graduate">College Gradaute</option>
                                    <option value="post_grad">Post Graduate</option>
                                    <option value="n/a">N/A</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" name="occupation" class="form-control" id="occupation" placeholder="Enter your occupation" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="employmentStatus" class="form-label">Employment Status</label>
                                <select name="employment_status" class="form-select" id="employmentStatus" required>
                                    <option disabled selected value="">Select employment status</option>
                                    <option value="employed">Employed</option>
                                    <option value="unemployed">Unemployed</option>
                                    <option value="self-employed">Self-employed</option>
                                    <option value="part_time">Part Time</option>
                                    <option value="full_time">Full Time</option>
                                </select>
                            </div>
                            <div class="col">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="tel" name="contact_number" class="form-control" id="contactNumber" 
                                   placeholder="Enter contact number" required 
                                   pattern="^\d{11}$" 
                                   title="Contact number must be exactly 11 digits" 
                                   maxlength="11">
                        </div>
                        </div>

                        <!-- Family Members Section -->
                        <div id="familyMembers">
                            <h5>Family Members</h5>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="familyFirstName1" class="form-label">First Name</label>
                                    <input type="text" name="family_first_names[]" class="form-control" id="familyFirstName1" placeholder="First name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="familyMiddleName1" class="form-label">Middle Name (if applicable)</label>
                                    <input type="text" name="family_middle_names[]" class="form-control" id="familyMiddleName1" placeholder="Middle name">
                                </div>
                                <div class="col-md-3">
                                    <label for="familyLastName1" class="form-label">Last Name</label>
                                    <input type="text" name="family_last_names[]" class="form-control" id="familyLastName1" placeholder="Last name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="familySuffix1" class="form-label">Suffix</label>
                                    <select name="family_suffixes[]" class="form-select" id="familySuffix1">
                                        <option disabled selected value="">select suffix (if applicable)</option>
                                        <option value="N/A">N/A</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="II">II (The Second)</option>
                                        <option value="III">III (The Third)</option>
                                    </select>
                                </div>
                           
                                <div class="col-md-3">
                                    <label for="sex" class="form-label">Sex</label>
                                    <select name="sex" class="form-select" id="sex" required>
                                        <option disabled selected value=""> Select your sex</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Prefer not to say</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="familyRelationship1" class="form-label">Family Relationship</label>
                                    <select name="family_relationships[]" class="form-control" id="familyRelationship1" required>
                                        <option disabled selected value="">Select Family Relationship</option>
                                        <option value="father">Father</option>
                                        <option value="mother">Mother</option>
                                        <option value="son">Son</option>
                                        <option value="daugther">Daugther</option>
                                        <option value="brother">Brother</option>
                                        <option value="sister">Sister</option>
                                        <option value="grandmother">Grandmother</option>
                                        <option value="grandfather">Grandfather</option>
                                        <option value="grandson">Grandson</option>
                                        <option value="granddaugther">Granddaugther</option>
                                        <option value="aunt">Aunt</option>
                                        <option value="uncle">Uncle</option>
                                        <option value="nephew">Nephew</option>
                                        <option value="niece">Niece</option>
                                        <option value="cousin">Cousin</option>
                                        <option value="husband">Husband</option>
                                        <option value="wife">Wife</option>
                                        <option value="father-in-law">Father-in-Law</option>
                                        <option value="mother-in-law">Mother-in-Law</option>
                                        <option value="son-in-law">Son-in-law</option>
                                        <option value="daugther-in-law">Daugther-in-law</option>
                                        <option value="brother-in-law">Brother-in-law</option>
                                        <option value="sister-in-law">Sister-in-law</option>
                                        <option value="stepfather">Stepfather</option>
                                        <option value="Stepmother">Stepmother</option>
                                        <option value="stepson">Stepson</option>
                                        <option value="stepdaugther">Stepdaugther</option>
                                        <option value="half-brother">Half-brother</option>
                                        <option value="half-sister">Half-sister</option>
                                     </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="familyBirthdate1" class="form-label">Birthdate</label>
                                    <input type="date" name="family_birthdates[]" class="form-control family-birthdate" id="familyBirthdate1" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="familyAge1" class="form-label">Age</label>
                                    <input type="number" name="family_ages[]" class="form-control family-age" id="familyAge1" readonly required>
                                </div>
                                
                                <div class="col">
                                    <label for="familyBirthplace1" class="form-label">Family Birthplace</label>
                                    <input type="text" name="family_birthplaces[]" class="form-control" id="familyBirthplace1" placeholder="Enter birthplace" required>
                                </div>
                                <div class="col mt-4">
                                    <button type="button" class="btn btn-danger remove-member">Remove</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" id="addFamilyMember">Add Family Member</button>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('templates.footer')
</div>
<script>
    // Function to calculate age
    function calculateAge(birthDate, ageField) {
        const dob = new Date(birthDate);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDifference = today.getMonth() - dob.getMonth();
        
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        
        ageField.value = age;
    }

    // Main DOB listener
    document.getElementById('dob').addEventListener('change', function() {
        calculateAge(this.value, document.getElementById('age'));
    });

    // Add Family Member
    document.getElementById('addFamilyMember').addEventListener('click', function () {
        const familyMembersDiv = document.getElementById('familyMembers');
        const memberCount = familyMembersDiv.querySelectorAll('.row').length + 1;

        const newMemberHTML = `
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="familyFirstName${memberCount}" class="form-label">First Name</label>
                    <input type="text" name="family_first_names[]" class="form-control" id="familyFirstName${memberCount}" placeholder="First name" required>
                </div>
                <div class="col-md-3">
                    <label for="familyMiddleName${memberCount}" class="form-label">Middle Name</label>
                    <input type="text" name="family_middle_names[]" class="form-control" id="familyMiddleName${memberCount}" placeholder="Middle name">
                </div>
                <div class="col-md-3">
                    <label for="familyLastName${memberCount}" class="form-label">Last Name</label>
                    <input type="text" name="family_last_names[]" class="form-control" id="familyLastName${memberCount}" placeholder="Last name" required>
                </div>
                <div class="col-md-3">
                    <label for="familySuffix${memberCount}" class="form-label">Suffix</label>
                    <select name="family_suffixes[]" class="form-select" id="familySuffix${memberCount}">
                        <option value="N/A">N/A</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="II">II (The Second)</option>
                        <option value="III">III (The Third)</option>
                    </select>
                </div>
                  <div class="col-md-3">
                <label for="familySex${memberCount}" class="form-label">Sex</label>
                <select name="family_sexes[]" class="form-select" id="familySex${memberCount}" required>
                    <option disabled selected value="">Select your sex</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Prefer not to say</option>
                </select>
            </div>
                <div class="col">
                    <label for="familyRelationship${memberCount}" class="form-label">Family Relationship</label>
                    <select name="family_relationships[]" class="form-select" id="familyRelationship${memberCount}" required>
                        <option value="">Select Family Relationship</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="son">Son</option>
                        <option value="daugther">Daugther</option>
                        <option value="brother">Brother</option>
                        <option value="sister">Sister</option>
                        <option value="grandmother">Grandmother</option>
                        <option value="grandfather">Grandfather</option>
                        <option value="grandson">Grandson</option>
                        <option value="granddaugther">Granddaugther</option>
                        <option value="aunt">Aunt</option>
                        <option value="uncle">Uncle</option>
                        <option value="nephew">Nephew</option>
                        <option value="niece">Niece</option>
                        <option value="cousin">Cousin</option>
                        <option value="husband">Husband</option>
                        <option value="wife">Wife</option>
                        <option value="father-in-law">Father-in-Law</option>
                        <option value="mother-in-law">Mother-in-Law</option>
                        <option value="son-in-law">Son-in-law</option>
                        <option value="daugther-in-law">Daugther-in-law</option>
                        <option value="brother-in-law">Brother-in-law</option>
                        <option value="sister-in-law">Sister-in-law</option>
                        <option value="stepfather">Stepfather</option>
                        <option value="Stepmother">Stepmother</option>
                        <option value="stepson">Stepson</option>
                        <option value="stepdaugther">Stepdaugther</option>
                        <option value="half-brother">Half-brother</option>
                        <option value="half-sister">Half-sister</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="familyBirthdate${memberCount}" class="form-label">Birthdate</label>
                    <input type="date" name="family_birthdates[]" class="form-control family-birthdate" id="familyBirthdate${memberCount}" required>
                </div>
                <div class="col-md-1">
                    <label for="familyAge${memberCount}" class="form-label">Age</label>
                    <input type="number" name="family_ages[]" class="form-control family-age" id="familyAge${memberCount}" readonly required>
                </div>
                <div class="col">
                    <label for="familyBirthplace${memberCount}" class="form-label">Family Birthplace</label>
                    <input type="text" name="family_birthplaces[]" class="form-control" id="familyBirthplace${memberCount}" placeholder="Enter birthplace" required>
                </div>
                <div class="col mt-4">
                    <button type="button" class="btn btn-danger remove-member">Remove</button>
                </div>
            </div>
        `;

        familyMembersDiv.insertAdjacentHTML('beforeend', newMemberHTML);

        // Add event listener to the new birthdate field
        const newBirthdateField = document.getElementById(`familyBirthdate${memberCount}`);
        const newAgeField = document.getElementById(`familyAge${memberCount}`);
        newBirthdateField.addEventListener('change', function() {
            calculateAge(this.value, newAgeField);
        });
    });

    // Event delegation for removing family member fields
    document.getElementById('familyMembers').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-member')) {
            event.target.closest('.row').remove();
        }
    });

    // Initial family member birthdate listener
    const initialBirthdate = document.getElementById('familyBirthdate1');
    if (initialBirthdate) {
        initialBirthdate.addEventListener('change', function() {
            calculateAge(this.value, document.getElementById('familyAge1'));
        });
    }

    // Contact number validation
    const contactNumber = document.getElementById('contactNumber');
    if (contactNumber) {
        contactNumber.addEventListener('input', function(e) {
            const value = e.target.value;
            e.target.value = value.replace(/[^0-9]/g, '').slice(0, 11);
        });
    }

    // Main DOB age calculation
    const mainDob = document.getElementById('dob');
    if (mainDob) {
        mainDob.addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDifference = today.getMonth() - dob.getMonth();
            
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('age').value = age;
        });
    }
    function generateEmail() {
    const firstName = document.getElementById('firstName').value.trim().toLowerCase().replace(/\s+/g, '');
    const middleName = document.getElementById('middleName').value.trim().toLowerCase().replace(/\s+/g, '');
    const lastName = document.getElementById('lastName').value.trim().toLowerCase().replace(/\s+/g, '');

    let email = `${firstName}${middleName ? middleName + '.' : ''}${lastName}@btms.com`;
    document.getElementById('generatedEmail').value = email;
}

// Add event listeners to generate email on input change
document.getElementById('firstName').addEventListener('input', generateEmail);
document.getElementById('middleName').addEventListener('input', generateEmail);
document.getElementById('lastName').addEventListener('input', generateEmail);
</script>
