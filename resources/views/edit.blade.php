@php
    $rejectedFields = json_decode($student->rejected_fields, true);
@endphp

<form method="POST" action="{{ route('students.resubmit', $student) }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}"
               @if(!in_array('first_name', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}"
               @if(!in_array('last_name', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $student->email) }}"
               @if(!in_array('email', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>Phone</label>
        <input type="text" name="contact_no" value="{{ old('contact_no', $student->contact_no) }}"
               @if(!in_array('contact_no', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>NIC</label>
        <input type="text" name="nic" value="{{ old('nic', $student->nic) }}"
               @if(!in_array('nic', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>Class Type</label>
        <select name="type[]" multiple @if(!in_array('type', $rejectedFields)) disabled @endif>
            <option value="Class A" @if(in_array('Class A', (array) $student->type)) selected @endif>Class A</option>
            <option value="Class B" @if(in_array('Class B', (array) $student->type)) selected @endif>Class B</option>
        </select>
    </div>

    <div>
        <label>Address</label>
        <input type="text" name="address" value="{{ old('address', $student->address) }}"
               @if(!in_array('address', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>Date of Birth</label>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}"
               @if(!in_array('date_of_birth', $rejectedFields)) disabled @endif>
    </div>

    <div>
        <label>Profile Image</label>
        <input type="file" name="image" accept="image/*"
               @if(!in_array('image', $rejectedFields)) disabled @endif>
    </div>

    <!-- 🔹 PDF Upload Section -->
    <div>
        <label>Upload PDF</label>
        <input type="file" name="pdf" accept="application/"
               @if(!in_array('pdf', $rejectedFields)) disabled @endif>
    </div>

    <button type="submit">Re-submit</button>
</form>
