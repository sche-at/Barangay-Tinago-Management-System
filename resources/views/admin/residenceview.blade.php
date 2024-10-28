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
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" width="100%">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Purok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($residences as $res)
                                <tr>
                                    <td>{{ $res->full_name }}</td>
                                    <td>{{ $res->contact_number }}</td>
                                    <td>{{ $res->purok }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deleteResidence({{ $res->id }})">Delete</button>
                                        <button class="btn btn-info btn-sm" data-id="{{ $res->id }}" onclick="showResidenceDetails({{ $res->id }})" data-bs-toggle="modal" data-bs-target="#ResidentModal">View Details</button>
                                    </td>
                                </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Resident Modal -->
    <div class="modal fade" id="ResidentModal" tabindex="-1" aria-labelledby="ResidentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResidentModalLabel">Resident Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="residentForm">
                    @csrf <!-- This directive generates a hidden input with the CSRF token -->
                        <input type="hidden" id="residentId">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" id="fullName" placeholder="Enter your full name" required>
                            </div>
                            <div class="col">
                                <label for="sex" class="form-label">Sex</label>
                                <select name="sex" class="form-select" id="sex" required>
                                    <option value="">Select your sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
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
                                    <option value="">Select civil status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="purok" class="form-label">Purok</label>
                                <input type="number" name="purok" class="form-control" id="purok" placeholder="Enter Purok" required>
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
                                    <option value="">Select educational level</option>
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
                                    <option value="">Select employment status</option>
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
                            <div class="row mb-3 family-member">
                                <div class="col">
                                    <label for="familyMemberName1" class="form-label">Family Member Name</label>
                                    <input type="text" name="family_members[]" class="form-control" id="familyMemberName1" placeholder="Enter family member name" required>
                                </div>
                                <div class="col">
                                    <label for="familyRelationship1" class="form-label">Family Relationship</label>
                                    <select name="family_relationships[]" class="form-control" id="familyRelationship1" required>
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
                                <div class="col">
                                    <label for="familyBirthdate1" class="form-label">Family Birthdate</label>
                                    <input type="date" name="family_birthdates[]" class="form-control" id="familyBirthdate1" required>
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
                    </form>
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
    function showResidenceDetails(id) {
    $.ajax({
        url: `/residences/${id}`,
        type: 'GET',
        success: function(residence) {
            // Fill out the modal with residence details
            $('#residentId').val(residence.id);
            $('#fullName').val(residence.full_name);
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
            residence.family_members.forEach((member, index) => {
                familyMembersContainer.append(`
                    <div class="row mb-3 family-member">
                        <div class="col">
                            <label for="familyMemberName${index + 1}" class="form-label">Family Member Name</label>
                            <input type="text" name="family_members[]" class="form-control" id="familyMemberName${index + 1}" value="${member.name}" required>
                        </div>
                        <div class="col">
                            <label for="familyRelationship${index + 1}" class="form-label">Family Relationship</label>
                            <input type="text" name="family_relationships[]" class="form-control" id="familyRelationship${index + 1}" value="${member.relationship}" required>
                        </div>
                        <div class="col">
                            <label for="familyBirthdate${index + 1}" class="form-label">Family Birthdate</label>
                            <input type="date" name="family_birthdates[]" class="form-control" id="familyBirthdate${index + 1}" value="${member.birthdate}" required>
                        </div>
                        <div class="col">
                            <label for="familyBirthplace${index + 1}" class="form-label">Family Birthplace</label>
                            <input type="text" name="family_birthplaces[]" class="form-control" id="familyBirthplace${index + 1}" value="${member.birthplace}" required>
                        </div>
                        <div class="col mt-4">
                            <button type="button" class="btn btn-danger remove-member">Remove</button>
                        </div>
                    </div>
                `);
            });
        },
        error: function() {
            alert('Failed to load residence details.');
        }
    });
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
            location.reload(); // Refresh the page to show updated data
        },
        error: function(xhr) {
            alert('An error occurred while updating the residence: ' + xhr.responseJSON.message);
        }
    });
});

    function deleteResidence(id) {
        if (confirm('Are you sure you want to delete this residence?')) {
            $.ajax({
                url: `/residencesdelete/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    alert('Residence deleted successfully!');
                    location.reload(); // Refresh the page to show updated data
                },
                error: function(xhr) {
                    alert('An error occurred while deleting the residence: ' + xhr.responseJSON.message || 'Unknown error');
                }
            });
        }
    }



   // Function to add family members dynamically
$('#addFamilyMember').on('click', function() {
    const memberIndex = $('.family-member').length + 1;
    $('#familyMembers').append(`
        <div class="row mb-3 family-member">
            <div class="col">
                <label for="familyMemberName${memberIndex}" class="form-label">Family Member Name</label>
                <input type="text" name="family_members[]" class="form-control" id="familyMemberName${memberIndex}" placeholder="Enter family member name" required>
            </div>
            <div class="col">
                <label for="familyRelationship${memberIndex}" class="form-label">Family Relationship</label>
                <select name="family_relationships[]" class="form-control" id="familyRelationship${memberIndex}" required>
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
            <div class="col">
                <label for="familyBirthdate${memberIndex}" class="form-label">Family Birthdate</label>
                <input type="date" name="family_birthdates[]" class="form-control" id="familyBirthdate${memberIndex}" required>
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
});


    // Remove family member
    $(document).on('click', '.remove-member', function() {
        $(this).closest('.family-member').remove();
    });

    //for 11 digits
    document.getElementById('contactNumber').addEventListener('input', function (e) {
        const value = e.target.value;
        // Limit input to numbers only
        e.target.value = value.replace(/[^0-9]/g, '').slice(0, 11);
    });

    //for automatic na mo edad

    document.getElementById('dob').addEventListener('change', function () {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDifference = today.getMonth() - dob.getMonth();
        
        // Adjust age if birthday hasn't occurred this year yet
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        document.getElementById('age').value = age;
    });

</script>
