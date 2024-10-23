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
                                <input type="number" name="age" class="form-control" id="age" placeholder="Enter your age" min="0" required>
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
                                    <option value="highschool">High School</option>
                                    <option value="bachelor">Bachelor's Degree</option>
                                    <option value="master">Master's Degree</option>
                                    <option value="phd">Ph.D.</option>
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
                                </select>
                            </div>
                            <div class="col">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" name="contact_number" class="form-control" id="contactNumber" placeholder="Enter contact number" required>
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
                                    <input type="text" name="family_relationships[]" class="form-control" id="familyRelationship1" placeholder="Enter relationship" required>
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
    document.getElementById('addFamilyMember').addEventListener('click', function () {
        const familyMembersDiv = document.getElementById('familyMembers');
        const memberCount = familyMembersDiv.querySelectorAll('.family-member').length + 1;

        const newMemberHTML = `
            <div class="row mb-3 family-member">
                <div class="col">
                    <label for="familyMemberName${memberCount}" class="form-label">Family Member Name</label>
                    <input type="text" name="family_members[]" class="form-control" id="familyMemberName${memberCount}" placeholder="Enter family member name" required>
                </div>
                <div class="col">
                    <label for="familyRelationship${memberCount}" class="form-label">Family Relationship</label>
                    <input type="text" name="family_relationships[]" class="form-control" id="familyRelationship${memberCount}" placeholder="Enter relationship" required>
                </div>
                <div class="col">
                    <label for="familyBirthdate${memberCount}" class="form-label">Family Birthdate</label>
                    <input type="date" name="family_birthdates[]" class="form-control" id="familyBirthdate${memberCount}" required>
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
    });

    // Event delegation for removing family member fields
    document.getElementById('familyMembers').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-member')) {
            event.target.closest('.family-member').remove();
        }
    });
</script>
