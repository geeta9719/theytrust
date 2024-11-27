<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <!-- Title Input (50 characters limit) -->
        <div class="form-group">
            <label for="title">Title (max 50 characters)</label>
            <input
                type="text"
                id="title"
                class="form-control {{ strlen($tagline) > 50 ? 'border-danger text-danger' : 'border-success' }}"
                wire:model.debounce.500ms="tagline"
                maxlength="50"
                placeholder="Enter title"
            />
            <div class="text-muted">{{ strlen($tagline) }} / 50 characters</div>
            @error('tagline')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Message Input (5000 character limit) -->
        <div class="form-group">
            <label for="short_description">Message (max 5000 characters)</label>
            <textarea
                id="short_description"
                rows="5"
                class="form-control {{ strlen($short_description) > 5000 ? 'border-danger text-danger' : 'border-success' }}"
                wire:model.debounce.500ms="short_description"
                maxlength="5000"
                placeholder="Enter message"
            ></textarea>
            <div class="text-muted">{{ strlen($short_description) }} / 5000 characters</div>
            @error('short_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Organization Size -->
        <div class="form-group">
            <label for="size">Organization Size</label>
            <select wire:model="size" id="size" class="form-control">
                <option value="">Select size</option>
                <!-- Add options here -->
            </select>
            @error('size')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Budget -->
        <div class="form-group">
            <label for="budget">Project Budget</label>
            <select wire:model="budget" id="budget" class="form-control">
                <option value="">Select budget</option>
                <!-- Add options here -->
            </select>
            @error('budget')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons: Next and Save & Exit -->
        <div class="form-group text-center">
            <button wire:click.prevent="save(false)" class="btn btn-primary">Next</button>
            <button wire:click.prevent="save(true)" class="btn btn-secondary">Save & Exit</button>
        </div>
    </form>
</div>
