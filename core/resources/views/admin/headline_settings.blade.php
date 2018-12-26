@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Headline Settings </h2>
        <div class="card mb-4">

            <div class="card-body">
                <table>
                    <thead>
                    <tr>
                        <th>Choose Preference</th>
                        <th>News Id</th>
                        <th>News Title </th>
                    </tr>
                    </thead>
                    <tbody>
                        <form>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-primary">Number 1</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-success">Number 2</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-danger">Number 3</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-warning">Number 4</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-info">Number 5</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-dark">Number 6</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-secondary">Number 7</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-success">Number 8</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-primary">Number 9</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-danger">Number 10</button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="inputNumber" placeholder="Insert News Id">
                                </td>

                                <td>

                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    function backgroundColor () {
        var inputSelected = document.getElementsByName("color")[0];
        inputSelected.style.backgroundColor = document.getElementsByName("color")[0].value;
    }
    </script>
@stop