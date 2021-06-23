<html>
    <head>
        <title>{{$title}}</title>
    </head>
    <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                color: rgb(8, 7, 7);
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -10px; 
                left: 0px; 
                right: 0px;
                height: 100px; 

                /** Extra personal styles **/
                color: rgb(8, 7, 7);
                text-align: right;
                line-height: 30px;

            }
        </style>
    
<body>
    <header>
        Notulensi Rapat
    </header>
        <hr>
        <table>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>
                     {{$notulens->id}}/{{$romawi}}/{{$year}}
                    </td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>
                    {{$notulens->place}}
                    </td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>
                    <b>
                    {{$notulens->title}}
                    </b>
                    </td>
                </tr>
        </table>
        <section align="justify">
                {!! $notulens->content !!}
        </section>
        
         <footer>
             <p>Hormat Saya</p>
                <img src="{{asset('storage/'.$notulens->member->signature)}}" style="width: 50px">
             <p style="color: black">{{$notulens->member->name}}</p>
        </footer>
</body>
</html>