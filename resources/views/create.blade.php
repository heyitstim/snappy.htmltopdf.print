<x-app-layout>
    <x-slot name="header">
        @error('image')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create DTR Data') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <form method="post" action="{{ route('dtrform.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="uemail">Email address</label>
                                <input type="email" name="uemail" class="form-control" id="uemail"
                                    placeholder="juan.delacruz@gmail.com">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="uname">Name</label>
                                        <input name="uname" type="text" class="form-control" id="uname"
                                            placeholder="Juan Dela Cruz">
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label for="timeperiod">Period</label>
                                        <select id="timeperiod" name="timeperiod" class="form-control" required>
                                            <option value="Time In">Time In</option>
                                            <option value="Start Lunch">Start Lunch</option>
                                            <option value="End Lunch">End Lunch</option>
                                            <option value="Time Out">Time Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="uimage">Upload File Here</label>
                                    <input type="file" class="form-control-file" id="uimage" name="uimage">
                                    <img id="data_img" class="rounded-top border border-dark"
                                        src="/images/image-not-found.png" alt="preview image" style="max-height: 80px;">
                                </div>
                                <button type="submit" class="btn btn-dark ">Submit</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        $('#uimage').change(function() {
            let img_reader = new FileReader();
            img_reader.onload = (e) => {
                $('#data_img').attr('src', e.target.result);
            }
            img_reader.readAsDataURL(this.files[0]);
        });

    });
</script>
