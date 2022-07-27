<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daily Time Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <div class="text-center">
                                    <img src="{{ url('/images/sample2_pfp.jpg') }}"
                                        class="img-fluid img-thumbnail rounded mx-auto d-block"
                                        style="width: 75%; height: 75%" alt="...">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div role="separator" class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            aria-label="Text input with dropdown button" placeholder="ENTER BARCODE">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h1 id="displayDateTime" style="text-align: center; font-weight:bold"></h1>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">DATE & TIME</th>
                                            <th scope="col">NAME</th>
                                            <th scope="col">PERIOD</th>
                                        </tr>
                                    </thead>
                                    @if (isset($data))
                                        @foreach ($data as $item)
                                            <tbody>
                                                <tr>
                                                    <th scope="row" name="date&time">{{ $item->date }}</th>
                                                    <td name="fname">{{ $item->name }}</td>
                                                    <td name="period">{{ $item->period }}</td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="container min-vh-110 min-vw-50">
                                <form method="get" action="/wkhtmltopdf">
                                    @csrf
                                    <h2 style="text-align: center;"><label for="Manual Time In Form">Download or View
                                            HTML to PDF</label></h2>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <div class="input-group input-group-lg">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                            id="inputGroup-sizing-lg">FullName</span>
                                                    </div>
                                                    <input type="text" name="fname_field" id="fname"
                                                        class="form-control" aria-label="Large"
                                                        aria-describedby="inputGroup-sizing-sm"
                                                        placeholder="{{ Auth::user()->name }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select id="timeperiod" name="timeperiod"
                                                    class="form-control-lg form-control" required>
                                                    <option value="Time In">Time In</option>
                                                    <option value="Start Lunch">Start Lunch</option>
                                                    <option value="End Lunch">End Lunch</option>
                                                    <option value="Time Out">Time Out</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="c1form"
                                                            name="form_radio" class="custom-control-input" value="c1form">
                                                        <label class="custom-control-label"
                                                            for="c1form">C1 Form</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="c2form"
                                                            name="form_radio" class="custom-control-input" value="c2form">
                                                        <label class="custom-control-label"
                                                            for="c2form">C2 Form</label>
                                                    </div>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="download" name="downloadpdf" value="on">
                                                        <label class="custom-control-label" for="download">Download
                                                            Only</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-dark ">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var today = new Date();
            var day = today.getDay();
            var daylist = ["Sunday", "Monday", "Tuesday", "Wednesday ", "Thursday", "Friday", "Saturday"];
            var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = date + ' ' + time;

            document.getElementById("displayDateTime").innerHTML = dateTime + ' ' + daylist[day];
        </script>
</x-app-layout>
