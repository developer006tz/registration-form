@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-6">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.text
            name="phone"
            label="Phone"
            :value="old('phone', ($editing ? $user->phone : ''))"
            maxlength="255"
            placeholder="Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.date
            name="dob"
            label="Dob"
            value="{{ old('dob', ($editing ? optional($user->dob)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.select name="district_id" label="District" required>
            @php $selected = old('district_id', ($editing ? $user->district_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the District</option>
            @foreach($districts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.select name="regions_id" label="Regions" required>
            @php $selected = old('regions_id', ($editing ? $user->regions_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Regions</option>
            @foreach($allRegions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>


    <x-inputs.group class="col-sm-6">
        <x-inputs.select name="languages[]" label="Language Prophiciency" class="select2" multiple="multiple" required>
            @php $selected = old('languages', ($editing ? $user->languages : '')) @endphp
           
            @foreach($languages as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>



</div>
