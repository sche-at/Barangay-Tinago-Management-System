@include('templates.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            {{-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Archived Residence List
                    </div>
                    <a href="{{ route('residence.view') }}" class="btn btn-primary btn-sm text-white text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i>Back to Residents
                    </a>                </div>

                <!-- Search Form -->
                <div class="card-body border-bottom">
                    <form action="{{ route('residences.archived') }}" method="GET" class="row g-3">
                        {{-- <div class="col-md-6"> --}}
                            {{-- <input type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Search by name, purok, or address..."
                                class="form-control"> --}}
                        </div>
                        {{-- <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('residences.archived') }}" class="btn btn-secondary">Reset</a>
                        </div> --}}
                    </form>
                </div>

                <div class="card-body">
                    <table id="datatablesSimple" width="100%">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Purok</th>
                                <th>Archived Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($archivedResidences as $res)
                            <tr>
                                <td>
                                    <div>{{ $res->first_name }} {{ $res->middle_name ? $res->middle_name . ' ' : '' }}{{ $res->last_name }}{{ $res->suffix != 'N/A' ? ' ' . $res->suffix : '' }}</div>
                                    {{-- <div class="small text-muted">Age: {{ $res->age }}</div> --}}
                                </td>
                                <td>
                                    <div>{{ $res->contact_number }}</div>
                                    {{-- <div class="small text-muted">{{ $res->occupation }}</div> --}}
                                </td>
                                <td>
                                    <div>Purok {{ $res->purok }}</div>
                                    {{-- <div class="small text-muted">{{ $res->address }}</div> --}}
                                </td>
                                <td>
                                    <div>{{ $res->deleted_at->format('M d, Y') }}</div>
                                    {{-- <div class="small text-muted">{{ $res->deleted_at->format('h:i A') }}</div> --}}
                                </td>
                                <td>
                                    <form action="{{ route('residences.restore', $res->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">  <i class="fas fa-undo me-1"></i>Restore</button>
                                    </form>
                                    <form action="{{ route('residences.forceDelete', $res->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this record?')"><i class="fas fa-trash me-1"></i>Delete</button>
                                    </form>
                                    <button class="btn btn-primary btn-sm" data-id="{{ $res->id }}" onclick="showResidenceDetails({{ $res->id }})" data-bs-toggle="modal" data-bs-target="#ResidentModal">View Details</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No archived records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $archivedResidences->links() }}
                    </div>
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
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" id="middleName" placeholder="Enter middle name">
                            </div>
                            <div class="col-md-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="suffix" class="form-label">Suffix</label>
                                <select name="suffix" class="form-select" id="suffix">
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
                                    <option value="">Select your sex</option>
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
                                    <option value="">Select civil status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="purok" class="form-label">Purok</label>
                                 <select name="purok" class="form-control" id="purok" placeholder="Enter Purok" required>
                                    <option value="">Select Purok</option>
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
                                <div class="col-md-3">
                                    <label for="familyFirstName1" class="form-label">First Name</label>
                                    <input type="text" name="family_first_names[]" class="form-control" id="familyFirstName1" placeholder="First name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="familyMiddleName1" class="form-label">Middle Name</label>
                                    <input type="text" name="family_middle_names[]" class="form-control" id="familyMiddleName1" placeholder="Middle name">
                                </div>
                                <div class="col-md-3">
                                    <label for="familyLastName1" class="form-label">Last Name</label>
                                    <input type="text" name="family_last_names[]" class="form-control" id="familyLastName1" placeholder="Last name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="familySuffix1" class="form-label">Suffix</label>
                                    <select name="family_suffixes[]" class="form-select" id="familySuffix1">
                                        <option value="N/A">N/A</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="II">II (The Second)</option>
                                        <option value="III">III (The Third)</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="familyRelationship1" class="form-label">Family Relationship</label>
                                    <select name="family_relationships[]" class="form-control" id="familyRelationship1" required>
                                        <option value="">Select relationship</option>
                                        <option value="spouse">Spouse</option>
                                        <option value="child">Child</option>
                                        <option value="parent">Parent</option>
                                        <option value="sibling">Sibling</option>
                                        <option value="grandparent">Grandparent</option>
                                        <option value="other">Other</option>
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
                                {{-- <div class="col mt-4">
                                    <button type="button" class="btn btn-danger remove-member">Remove</button>
                                </div> --}}
                            </div>
                        </div>

                        {{-- <button type="button" class="btn btn-primary" id="addFamilyMember">Add Family Member</button> --}}
                
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" id="saveResidentBtn">Save Changes</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.footer')

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
    
    // Show residence details
    function showResidenceDetails(id) {
        $.ajax({
            url: `/residences/archived/${id}`,
            type: 'GET',
            success: function(residence) {
                // Basic Information
                $('#residentId').val(residence.id);
                $('#firstName').val(residence.first_name).prop('disabled', true);
                $('#middleName').val(residence.middle_name).prop('disabled', true);
                $('#lastName').val(residence.last_name).prop('disabled', true);
                $('#suffix').val(residence.suffix || 'N/A').prop('disabled', true);
                $('#sex').val(residence.sex).prop('disabled', true);
                $('#dob').val(residence.date_of_birth).prop('disabled', true);
                $('#age').val(residence.age).prop('disabled', true);
                $('#civilStatus').val(residence.civil_status).prop('disabled', true);
                $('#purok').val(residence.purok).prop('disabled', true);
                $('#currentAddress').val(residence.address).prop('disabled', true);
                $('#placeOfBirth').val(residence.place_of_birth).prop('disabled', true);
                $('#educationalLevel').val(residence.educational_level).prop('disabled', true);
                $('#occupation').val(residence.occupation).prop('disabled', true);
                $('#employmentStatus').val(residence.employment_status).prop('disabled', true);
                $('#contactNumber').val(residence.contact_number).prop('disabled', true);
    
                // Handle Family Members
                const familyMembersContainer = $('#familyMembers');
familyMembersContainer.find('.family-member').not(':first').remove(); // Remove additional family member rows

if (residence.family_members && residence.family_members.length > 0) {
    residence.family_members.forEach((member, index) => {
        const relationshipOptions = `
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
        `;

        if (index === 0) {
            // Update first row
            $('#familyFirstName1').val(member.first_name).prop('disabled', true);
            $('#familyMiddleName1').val(member.middle_name).prop('disabled', true);
            $('#familyLastName1').val(member.last_name).prop('disabled', true);
            $('#familySuffix1').val(member.suffix || 'N/A').prop('disabled', true);
            $('#familyRelationship1')
                .html(relationshipOptions)
                .prop('disabled', true);
            $('#familyBirthdate1').val(member.birthdate).prop('disabled', true);
            $('#familyAge1').val(calculateAgeValue(member.birthdate)).prop('disabled', true);
            $('#familyBirthplace1').val(member.birthplace).prop('disabled', true);
        } else {
            // Add new rows for additional family members
            const newRow = `
                <div class="row mb-3 family-member">
                    <div class="col-md-3">
                        <label for="familyFirstName${index + 1}" class="form-label">First Name</label>
                        <input type="text" name="family_first_names[]" class="form-control" id="familyFirstName${index + 1}" value="${member.first_name || ''}" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="familyMiddleName${index + 1}" class="form-label">Middle Name</label>
                        <input type="text" name="family_middle_names[]" class="form-control" id="familyMiddleName${index + 1}" value="${member.middle_name || ''}" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="familyLastName${index + 1}" class="form-label">Last Name</label>
                        <input type="text" name="family_last_names[]" class="form-control" id="familyLastName${index + 1}" value="${member.last_name || ''}" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="familySuffix${index + 1}" class="form-label">Suffix</label>
                        <select name="family_suffixes[]" class="form-select" id="familySuffix${index + 1}" disabled>
                            <option value="N/A" ${member.suffix === 'N/A' ? 'selected' : ''}>N/A</option>
                            <option value="Jr." ${member.suffix === 'Jr.' ? 'selected' : ''}>Jr.</option>
                            <option value="Sr." ${member.suffix === 'Sr.' ? 'selected' : ''}>Sr.</option>
                            <option value="II" ${member.suffix === 'II' ? 'selected' : ''}>II (The Second)</option>
                            <option value="III" ${member.suffix === 'III' ? 'selected' : ''}>III (The Third)</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="familyRelationship${index + 1}" class="form-label">Family Relationship</label>
                        <select name="family_relationships[]" class="form-select" id="familyRelationship${index + 1}" disabled>
                            ${relationshipOptions}
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="familyBirthdate${index + 1}" class="form-label">Birthdate</label>
                        <input type="date" name="family_birthdates[]" class="form-control family-birthdate" id="familyBirthdate${index + 1}" value="${member.birthdate || ''}" disabled>
                    </div>
                    <div class="col-md-1">
                        <label for="familyAge${index + 1}" class="form-label">Age</label>
                        <input type="number" name="family_ages[]" class="form-control family-age" id="familyAge${index + 1}" value="${member.birthdate ? calculateAgeValue(member.birthdate) : ''}" disabled>
                    </div>
                    <div class="col">
                        <label for="familyBirthplace${index + 1}" class="form-label">Family Birthplace</label>
                        <input type="text" name="family_birthplaces[]" class="form-control" id="familyBirthplace${index + 1}" value="${member.birthplace || ''}" disabled>
                    </div>
                </div>
            `;
            familyMembersContainer.append(newRow);
        }
    });
}
            },
            error: function(xhr) {
                alert('Failed to load residence details: ' + xhr.responseText);
                console.error('Error loading residence details:', xhr);
            }
        });
    }
    
    // Helper function to calculate age
    function calculateAgeValue(birthDate) {
        const dob = new Date(birthDate);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDifference = today.getMonth() - dob.getMonth();
        
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        
        return age;
    }
    </script>