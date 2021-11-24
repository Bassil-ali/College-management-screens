<select class="uk-select" name="{{ $name }}">
    @for ($h = 7; $h < 16; $h++)
        @for ($m = 0; $m < 60; $m += 15)
        @php
            $value = sprintf('%02d:%02d:00', $h, $m);
        @endphp
        <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>{{ sprintf('%02d:%02d', $h, $m) }}</option>
        @endfor
    @endfor
</select>
