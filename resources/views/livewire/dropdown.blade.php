<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="form-group">
        <label for="college">College</label>
        <select class="form-control" id="college" name="college" required wire:model="selectedCollege">
            <option selected value="">-Choose College-</option>
            @foreach ($college as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    
    </div>

    

    <div class="form-group">
                <div class="col-sm-10">
                    <label for="status">Select a Section</label>
                    <select class="form-control" wire:model="selecteDepartent">
                        <option value="">Select a Section</option>
                        @foreach ($department as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


    


</div>
