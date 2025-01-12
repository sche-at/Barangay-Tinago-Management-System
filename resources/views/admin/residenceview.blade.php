@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Residence List
                    </div>
                    <button class="btn btn-secondary me-2" onclick="window.location.href='{{ route('residences.archived') }}'">
                        <i class="fas fa-archive me-1"></i>View Archived
                    </button>
                </div>
                
                <!-- Filtering Section -->
                <div class="card-header">
                    <div class="row">
                        
                        <div class="col-md-3">
                            <label for="nameFilter" class="form-label">Filter by Name</label>
                            <input type="text" id="nameFilter" class="form-control" placeholder="Enter name">
                        </div>
                        
                        <form id="filterForm" method="GET" action="{{ route('residence.view') }}">
                            <label for="purokFilter">Filter by Purok</label>
                            <select id="purokFilter" name="purok" class="form-select">
                                <option value="">All Puroks</option>
                                <option value="1">Purok 1</option>
                                <option value="2">Purok 2</option>
                                <option value="3">Purok 3</option>
                                <option value="4">Purok 4</option>
                                <option value="5">Purok 5</option>
                                <option value="6">Purok 6</option>
                                <option value="7">Purok 7</option>
                            </select>
                            {{-- <button type="submit" class="btn btn-primary">Filter</button> --}}
                        </form>

                        <div class="col-md-3">
                            <label for="genderFilter" class="form-label">Filter by Gender</label>
                            <select id="genderFilter" class="form-select">
                                <option value="">All Genders</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="ageMinFilter" class="form-label">Minimum Age</label>
                            <input type="number" id="ageMinFilter" class="form-control" min="0" max="120" placeholder="Min Age">
                        </div>
                        <div class="col-md-3">
                            <label for="ageMaxFilter" class="form-label">Maximum Age</label>
                            <input type="number" id="ageMaxFilter" class="form-control" min="0" max="120" placeholder="Max Age">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <button id="printFilteredDataBtn" class="btn btn-success">Print Filtered Data</button>
                        </div>
                    </div>
                    <table id="datatablesSimple1" width="100%">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Purok</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($residences as $res)
                            <!-- Head of Family -->
                            <tr data-purok="{{ $res->purok }}" 
                                data-gender="{{ $res->sex }}" 
                                data-age="{{ $res->age }}">
                                <td>{{ $res->first_name }} {{ $res->middle_name ? $res->middle_name . ' ' : '' }}{{ $res->last_name }}{{ $res->suffix != 'N/A' ? ' ' . $res->suffix : '' }}</td>
                                <td>{{ $res->contact_number }}</td>
                                <td>{{ $res->purok }}</td>
                                <td>{{ $res->sex }}</td>
                                <td>{{ $res->age }}</td>
                                <td>
                                    <form id="delete-form-{{ $res->id }}" action="{{ route('residence.destroy', $res->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Archived</button>
                                    </form>
                                    <button class="btn btn-primary btn-sm" data-id="{{ $res->id }}" onclick="showResidenceDetails({{ $res->id }})" data-bs-toggle="modal" data-bs-target="#ResidentModal">View Details</button>
                                </td>
                                
                            </tr>
                            
                            <!-- Family Members (Under the Head of Family) -->
@foreach($res->familyMembers as $familyMember)
<tr class="family-member" data-purok="{{ $res->purok }}" 
    data-gender="{{ $familyMember->sex }}" 
    data-age="{{ $familyMember->age }}">
    <td>{{ $familyMember->first_name }} {{ $familyMember->middle_name ? $familyMember->middle_name . ' ' : '' }}{{ $familyMember->last_name }}{{ $familyMember->suffix != 'N/A' ? ' ' . $familyMember->suffix : '' }}</td>
    <td>{{ $familyMember->contact_number }}</td>
    <td>{{ $familyMember->purok }}</td>
    <td>{{ $familyMember->sex }}</td>
    <td>{{ $familyMember->age }}</td>
    <td></td>
</tr>
@endforeach
                            
                        @endforeach
                        
                        </tbody>
                    </table>
            
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade" id="ResidentModal" tabindex="-1" aria-labelledby="ResidentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResidentModalLabel">Resident Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="residentForm">
                    @csrf
                        <input type="hidden" id="residentId">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter first name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="middleName" class="form-label">Middle Name (if applicable)</label>
                                <input type="text" name="middle_name" class="form-control" id="middleName" placeholder="Enter middle name">
                            </div>
                            <div class="col-md-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="suffix" class="form-label">Suffix</label>
                                <select name="suffix" class="form-select" id="suffix">
                                    <option disabled selected value="">select suffix (if applicable) </option>
                                    <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II (The Second)</option>
                                    <option value="III">III (The Third)</option>
                                </select>
                            </div>
                        </div>

                           <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="sex" class="form-label">Sex</label>
                                <select name="sex" class="form-select" id="sex" required>
                                    <option disabled selected value="">Select your sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" id="dob" required>
                            </div>
                            <div class="col">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" id="age" readonly required>
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
                                    <option disabled selected  value="">Select Purok</option>
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
                                    <option disabled selected value="">Select Educational Level</option>
                                    <option value="elementary_level">Elementary Level</option>
                                    <option value="elementary_graduate">Elementary Graduate</option>
                                    <option value="highschool_level">Highschool Levle</option>
                                    <option value="highschool_graduate">Highschool Graduate</option>
                                    <option value="college_level">College Level</option>
                                    <option value="college_graduate">College Gradaute</option>
                                    <option value="post_grad">Post Graduate</option>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveResidentBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
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


 // Fix for showResidenceDetails function
 function showResidenceDetails(id) {
    $.ajax({
        url: `/residences/${id}`,
        type: 'GET',
        success: function(residence) {
            // Fill out the modal with residence details
            $('#residentId').val(residence.id);
            $('#firstName').val(residence.first_name);
            $('#middleName').val(residence.middle_name);
            $('#lastName').val(residence.last_name);
            $('#suffix').val(residence.suffix || 'N/A');
            $('#sex').val(residence.sex);
            $('#dob').val(residence.date_of_birth);
            $('#age').val(residence.age);
            $('#civilStatus').val(residence.civil_status);
            $('#purok').val(residence.purok);
            $('#currentAddress').val(residence.address);
            $('#placeOfBirth').val(residence.place_of_birth);
            $('#educationalLevel').val(residence.educational_level);
            $('#occupation').val(residence.occupation);
            $('#employmentStatus').val(residence.employment_status);
            $('#contactNumber').val(residence.contact_number);

            // Handle family members
            const familyMembersContainer = $('#familyMembers');
            familyMembersContainer.empty();

            if (residence.family_members && residence.family_members.length > 0) {
                const familyMemberRows = [];

                residence.family_members.forEach((member, index) => {
                    const familyMemberRow = $('<div>').addClass('row mb-3 family-member');


                    familyMemberRow.append(`
                     <h5>Family Members</h5>
                        <div class="col-md-3">
                            <label for="familyFirstName${index + 1}" class="form-label">First Name</label>
                            <input type="text" name="family_first_names[]" class="form-control" id="familyFirstName${index + 1}" value="${member.first_name}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="familyMiddleName${index + 1}" class="form-label">Middle Name</label>
                            <input type="text" name="family_middle_names[]" class="form-control" id="familyMiddleName${index + 1}" value="${member.middle_name}">
                        </div>
                        <div class="col-md-3">
                            <label for="familyLastName${index + 1}" class="form-label">Last Name</label>
                            <input type="text" name="family_last_names[]" class="form-control" id="familyLastName${index + 1}" value="${member.last_name}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="familySuffix${index + 1}" class="form-label">Suffix</label>
                            <select name="family_suffixes[]" class="form-select" id="familySuffix${index + 1}">
                                <option value="N/A" ${member.suffix === 'N/A' ? 'selected' : ''}>N/A</option>
                                <option value="Jr." ${member.suffix === 'Jr.' ? 'selected' : ''}>Jr.</option>
                                <option value="Sr." ${member.suffix === 'Sr.' ? 'selected' : ''}>Sr.</option>
                                <option value="II" ${member.suffix === 'II' ? 'selected' : ''}>II (The Second)</option>
                                <option value="III" ${member.suffix === 'III' ? 'selected' : ''}>III (The Third)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
    <label for="familySex${index + 1}" class="form-label">Sex</label>
    <select name="family_sexes[]" class="form-select" id="familySex${index + 1}">
        <option value="male" ${member.sex === 'male' ? 'selected' : ''}>Male</option>
        <option value="female" ${member.sex === 'female' ? 'selected' : ''}>Female</option>
        <option value="other" ${member.sex === 'other' ? 'selected' : ''}>Prefer not to say</option>
    </select>
</div>

                        <div class="col-md-3">
                            <label for="familyRelationship${index + 1}" class="form-label">Family Relationship</label>
                            <select name="family_relationships[]" class="form-select" id="familyRelationship${index + 1}" required>
                                <option value="">Select Family Relationship</option>
                                <option value="father" ${member.relationship === 'father' ? 'selected' : ''}>Father</option>
                                <option value="mother" ${member.relationship === 'mother' ? 'selected' : ''}>Mother</option>
                                <option value="son" ${member.relationship === 'son' ? 'selected' : ''}>Son</option>
                                <option value="daughter" ${member.relationship === 'daughter' ? 'selected' : ''}>Daughter</option>
                                <option value="brother" ${member.relationship === 'brother' ? 'selected' : ''}>Brother</option>
                                <option value="sister" ${member.relationship === 'sister' ? 'selected' : ''}>Sister</option>
                                <option value="grandmother" ${member.relationship === 'grandmother' ? 'selected' : ''}>Grandmother</option>
                                <option value="grandfather" ${member.relationship === 'grandfather' ? 'selected' : ''}>Grandfather</option>
                                <option value="grandson" ${member.relationship === 'grandson' ? 'selected' : ''}>Grandson</option>
                                <option value="granddaughter" ${member.relationship === 'granddaughter' ? 'selected' : ''}>Granddaughter</option>
                                <option value="aunt" ${member.relationship === 'aunt' ? 'selected' : ''}>Aunt</option>
                                <option value="uncle" ${member.relationship === 'uncle' ? 'selected' : ''}>Uncle</option>
                                <option value="nephew" ${member.relationship === 'nephew' ? 'selected' : ''}>Nephew</option>
                                <option value="niece" ${member.relationship === 'niece' ? 'selected' : ''}>Niece</option>
                                <option value="cousin" ${member.relationship === 'cousin' ? 'selected' : ''}>Cousin</option>
                                <option value="husband" ${member.relationship === 'husband' ? 'selected' : ''}>Husband</option>
                                <option value="wife" ${member.relationship === 'wife' ? 'selected' : ''}>Wife</option>
                                <option value="father-in-law" ${member.relationship === 'father-in-law' ? 'selected' : ''}>Father-in-Law</option>
                                <option value="mother-in-law" ${member.relationship === 'mother-in-law' ? 'selected' : ''}>Mother-in-Law</option>
                                <option value="son-in-law" ${member.relationship === 'son-in-law' ? 'selected' : ''}>Son-in-law</option>
                                <option value="daughter-in-law" ${member.relationship === 'daughter-in-law' ? 'selected' : ''}>Daughter-in-law</option>
                                <option value="brother-in-law" ${member.relationship === 'brother-in-law' ? 'selected' : ''}>Brother-in-law</option>
                                <option value="sister-in-law" ${member.relationship === 'sister-in-law' ? 'selected' : ''}>Sister-in-law</option>
                                <option value="stepfather" ${member.relationship === 'stepfather' ? 'selected' : ''}>Stepfather</option>
                                <option value="stepmother" ${member.relationship === 'stepmother' ? 'selected' : ''}>Stepmother</option>
                                <option value="stepson" ${member.relationship === 'stepson' ? 'selected' : ''}>Stepson</option>
                                <option value="stepdaughter" ${member.relationship === 'stepdaughter' ? 'selected' : ''}>Stepdaughter</option>
                                <option value="half-brother" ${member.relationship === 'half-brother' ? 'selected' : ''}>Half-brother</option>
                                <option value="half-sister" ${member.relationship === 'half-sister' ? 'selected' : ''}>Half-sister</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="familyBirthdate${index + 1}" class="form-label">Birthdate</label>
                            <input type="date" name="family_birthdates[]" class="form-control family-birthdate" id="familyBirthdate${index + 1}" value="${member.birthdate}" required>
                        </div>
                        <div class="col-md-1">
                            <label for="familyAge${index + 1}" class="form-label">Age</label>
                            <input type="number" name="family_ages[]" class="form-control family-age" id="familyAge${index + 1}" value="${calculateAge(member.birthdate)}"  readonly required>
                        </div>
                        <div class="col-md-3">
                            <label for="familyBirthplace${index + 1}" class="form-label">Family Birthplace</label>
                            <input type="text" name="family_birthplaces[]" class="form-control" id="familyBirthplace${index + 1}" value="${member.birthplace}" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-member">Remove</button>
                        </div>
                    `);

                        
                   
                    
                    familyMemberRows.push(familyMemberRow);
                });

                familyMembersContainer.append(familyMemberRows);
            } else {
                familyMembersContainer.append(`
                    <div class="row mb-3">
                        <div class="col">
                            <p>No family members added yet.</p>
                        </div>
                    </div>
                `);
            }
            
        },
        error: function() {
            alert('Failed to load residence details.');
        }
    });

    function calculateAge(birthDateString) {
    // Convert string to Date object
    const birthDate = new Date(birthDateString);
    const today = new Date();

    // Calculate age
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    return age;
}

}




// Function to handle updating a residence
$('#saveResidentBtn').on('click', function() {
    const id = $('#residentId').val();
    const formData = $('#residentForm').serialize();
    $.ajax({
        url: `/residences/${id}`,
        type: 'PUT',
        data: formData,
        success: function(response) {
            alert('Residence updated successfully!');
            location.reload();
        },
        error: function(xhr) {
            alert('An error occurred while updating the residence: ' + xhr.responseJSON.message);
        }
    });
});

 // Function to delete residence
function deleteResidence(id) {
    if (confirm('Are you sure you want to delete this residence?')) {
        $.ajax({
            url: `/residencesdelete/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Residence deleted successfully!');
                location.reload();
            },
            error: function(xhr) {
                alert('An error occurred while deleting the residence: ' + xhr.responseJSON.message || 'Unknown error');
            }
        });
    }
}



    /// Function to add family members dynamically
// Function to add family members dynamically
$('#addFamilyMember').on('click', function() {
    const memberIndex = $('.family-member').length + 1;
    $('#familyMembers').append(`
        <div class="row mb-3 family-member">
            <div class="col-md-3">
                <label for="familyFirstName${memberIndex}" class="form-label">First Name</label>
                <input type="text" name="family_first_names[]" class="form-control" id="familyFirstName${memberIndex}" placeholder="Enter first name" required>
            </div>
            <div class="col-md-3">
                <label for="familyMiddleName${memberIndex}" class="form-label">Middle Name</label>
                <input type="text" name="family_middle_names[]" class="form-control" id="familyMiddleName${memberIndex}" placeholder="Enter middle name">
            </div>
            <div class="col-md-3">
                <label for="familyLastName${memberIndex}" class="form-label">Last Name</label>
                <input type="text" name="family_last_names[]" class="form-control" id="familyLastName${memberIndex}" placeholder="Enter last name" required>
            </div>
            <div class="col-md-3">
                <label for="familySuffix${memberIndex}" class="form-label">Suffix</label>
                <select name="family_suffixes[]" class="form-select" id="familySuffix${memberIndex}">
                    <option value="N/A">N/A</option>
                    <option value="Jr.">Jr.</option>
                    <option value="Sr.">Sr.</option>
                    <option value="II">II (The Second)</option>
                    <option value="III">III (The Third)</option>
                </select>
            </div>
            <div class="col">
                <label for="familyRelationship${memberIndex}" class="form-label">Family Relationship</label>
                <select name="family_relationships[]" class="form-select" id="familyRelationship${memberIndex}" required>
                    <option value="">Select Family Relationship</option>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="son">Son</option>
                    <option value="daughter">Daughter</option>
                    <option value="brother">Brother</option>
                    <option value="sister">Sister</option>
                    <option value="grandmother">Grandmother</option>
                    <option value="grandfather">Grandfather</option>
                    <option value="grandson">Grandson</option>
                    <option value="granddaughter">Granddaughter</option>
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
                    <option value="daughter-in-law">Daughter-in-law</option>
                    <option value="brother-in-law">Brother-in-law</option>
                    <option value="sister-in-law">Sister-in-law</option>
                    <option value="stepfather">Stepfather</option>
                    <option value="stepmother">Stepmother</option>
                    <option value="stepson">Stepson</option>
                    <option value="stepdaughter">Stepdaughter</option>
                    <option value="half-brother">Half-brother</option>
                    <option value="half-sister">Half-sister</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="familyBirthdate${memberIndex}" class="form-label">Birthdate</label>
                <input type="date" name="family_birthdates[]" class="form-control family-birthdate" id="familyBirthdate${memberIndex}" required>
            </div>
            <div class="col-md-1">
                <label for="familyAge${memberIndex}" class="form-label">Age</label>
                <input type="number" name="family_ages[]" class="form-control family-age" id="familyAge${memberIndex}" readonly required>
            </div>
            <div class="col">
                <label for="familyBirthplace${memberIndex}" class="form-label">Family Birthplace</label>
                <input type="text" name="family_birthplaces[]" class="form-control" id="familyBirthplace${memberIndex}" placeholder="Enter birthplace" required>
            </div>
            <div class="col mt-4">
                <button type="button" class="btn btn-danger remove-member">Remove</button>
            </div>
        </div>
    `);
    
        // Add event listener for birthdate change to calculate age
    const birthdateField = document.getElementById(`familyBirthdate${memberIndex}`);
    const ageField = document.getElementById(`familyAge${memberIndex}`);
    birthdateField.addEventListener('change', function() {
        calculateAge(this.value, ageField);
    });
});

// Remove family member (moved outside of addFamilyMember)
$(document).on('click', '.remove-member', function() {
    $(this).closest('.family-member').remove();
});

// Main DOB listener (moved outside of addFamilyMember)
document.getElementById('dob').addEventListener('change', function() {
    calculateAge(this.value, document.getElementById('age'));
});

document.addEventListener('DOMContentLoaded', function() {
    // Get filter elements
    const nameFilter = document.getElementById('nameFilter');
    const purokFilter = document.getElementById('purokFilter');
    const genderFilter = document.getElementById('genderFilter');
    const ageMinFilter = document.getElementById('ageMinFilter');
    const ageMaxFilter = document.getElementById('ageMaxFilter');
    const printFilteredDataBtn = document.getElementById('printFilteredDataBtn');

    // Get all table rows
    const rows = document.querySelectorAll('#datatablesSimple1 tbody tr');
    
    // Function to apply filters
    function applyFilters() {
        rows.forEach(row => {
            const fullName = row.cells[0].innerText.toLowerCase();  // Assuming Full Name is the first column
            const purok = row.getAttribute('data-purok');
            const gender = row.getAttribute('data-gender');
            const age = parseInt(row.getAttribute('data-age'));
            
            // Check Name filter
            const nameMatch = nameFilter.value === '' || fullName.includes(nameFilter.value.toLowerCase());
            
            // Check Purok filter
            const purokMatch = purokFilter.value === '' || purok === purokFilter.value;
            
            // Check Gender filter
            const genderMatch = genderFilter.value === '' || gender === genderFilter.value;
            
            // Check Age filters
            const minAge = ageMinFilter.value ? parseInt(ageMinFilter.value) : 0;
            const maxAge = ageMaxFilter.value ? parseInt(ageMaxFilter.value) : Infinity;
            const ageMatch = age >= minAge && age <= maxAge;
            
            // Show/hide row based on filters
            row.style.display = nameMatch && purokMatch && genderMatch && ageMatch ? '' : 'none';
        });
    }

    // Add event listeners to filter inputs
    nameFilter.addEventListener('input', applyFilters);
    purokFilter.addEventListener('change', applyFilters);
    genderFilter.addEventListener('change', applyFilters);
    ageMinFilter.addEventListener('input', applyFilters);
    ageMaxFilter.addEventListener('input', applyFilters);

    // Print Filtered Data functionality
    printFilteredDataBtn.addEventListener('click', function() {
        // Create a new window for printing
        const printWindow = window.open('', '_blank');
        const currentDate = new Date().toLocaleDateString();

        // Generate print content
        let printHTML = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Residence Report</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .report-container { width: 100%; max-width: 800px; margin: 0 auto; }
                    .report-header { text-align: center; margin-bottom: 20px; }
                    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    table, th, td { border: 1px solid black; }
                    th, td { padding: 8px; text-align: left; }
                    .report-footer { margin-top: 20px; }
                    .signatures { display: flex; justify-content: space-between; margin-top: 50px; }
                    .signature-block { width: 40%; text-align: center; }
                    .signature-line { border-top: 1px solid black; margin-bottom: 10px; }
                </style>
            </head>
            <body>
                <div class="report-container">
                    <div class="report-header">
                        <h4 style="margin: 10px 0;">Republic of the Philippines</h4>
                        <h4 style="margin: 10px 0;">Province of Bohol</h4>
                        <h4 style="margin: 10px 0;">Municipality of Dauis</h4>
                        <h3 style="margin: 15px 0;">OFFICE OF THE BARANGAY CAPTAIN</h3>
                        <h2 style="margin: 20px 0;">RESIDENCE REPORT</h2>
                        <p style="margin: 10px 0;">Date Generated: ${currentDate}</p>
        `;

        printHTML += `
    ${purokFilter.value === '' ? '' : `<p style="margin: 10px 0;">Purok: ${purokFilter.value}</p>`}
    ${genderFilter.value === '' ? '' : `<p style="margin: 10px 0;">Gender: ${genderFilter.value}</p>`}
`;




        let tableHeaders = `
        </div>

                    <table>
                        <thead>
                            
    <tr>
        <th>Full Name</th>
        <th>Contact Number</th>
        ${purokFilter.value !== '' ? '' : '<th>Purok</th>'} <!-- Show Purok only if filter is empty -->
        ${genderFilter.value !== '' ? '' : '<th>Gender</th>'} <!-- Show Gender only if filter is empty -->
        <th>Age</th>
    </tr>
`;

printHTML += tableHeaders;


        printHTML +=  ` </thead>
                        <tbody>`;

        // Collect and add only visible (filtered) rows
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                printHTML += `
                     <tr>
                <td>${row.cells[0].textContent}</td>
                <td>${row.cells[1].textContent}</td>
                ${purokFilter.value ? '' : `<td>${row.cells[2].textContent}</td>`}  <!-- Hide Purok if filtered -->
                ${genderFilter.value ? '' : `<td>${row.cells[3].textContent}</td>`}  <!-- Hide Gender if filtered -->
                <td>${row.cells[4].textContent}</td>
            </tr>
                `;
            }
        });

        const filteredRowsCount = document.querySelectorAll('#datatablesSimple1 tbody tr:not([style*="display: none"])').length;

        printHTML += `
                        </tbody>
                    </table>

                    <div class="report-footer">
                        <strong>Total Number of Residents: ${filteredRowsCount}</strong>
                        
                        <div class="signatures">
                            <div class="signature-block">
                                <div class="signature-line"></div>
                                <strong>Prepared by:</strong><br>
                                Barangay Secretary
                            </div>
                            
                            <div class="signature-block">
                                <div class="signature-line"></div>
                                <strong>Certified Correct:</strong><br>
                                Barangay Chairman
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    window.onload = function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        }
                    }
                <\/script>
            </body>
            </html>
        `;

        // Write the content to the new window
        printWindow.document.write(printHTML);
        printWindow.document.close();
    });
});
// document.getElementById('purokFilter').addEventListener('change', function() {
//     const purok = this.value;
//     let url = '{{ route('residence.view') }}';
    
//     if (purok !== '') {
//         url += `?purok=${purok}`;
//     }
    
//     fetch(url, {
//         headers: {
//             'X-Requested-With': 'XMLHttpRequest'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         // Debug log to see what data we're receiving
//         console.log('Received data:', data);
        
//         if (data.residences) {
//             updateResidenceTable(data.residences);
//         } else {
//             console.error('No residence data received');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });

// function updateResidenceTable(residences) {
//     const tableBody = document.querySelector('table tbody');
//     tableBody.innerHTML = '';
    
//     // Debug log to see residences data
//     console.log('Updating table with residences:', residences);
    
//     if (residences && residences.length > 0) {
//         residences.forEach(residence => {
//             // Debug log for each residence
//             console.log('Processing residence:', residence);
            
//             const row = `
//                 <tr>
//                     <td>${residence.household_no || ''}</td>
//                     <td>${residence.purok || ''}</td>
//                     <td>${residence.family_members ? residence.family_members.map(member => member.name).join(', ') : ''}</td>
//                     <!-- Add any other columns you need -->
//                 </tr>
//             `;
//             tableBody.innerHTML += row;
//         });
//     } else {
//         tableBody.innerHTML = `
//             <tr>
//                 <td colspan="3" class="text-center">No residences found</td>
//             </tr>
//         `;
//     }
// }
</script>
