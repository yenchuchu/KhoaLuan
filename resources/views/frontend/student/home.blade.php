<div class="container">
    <div class="row" id="home-id" style="margin-bottom: 30px">
        <div class="col-lg-12">
            <h1>EStore giúp bạn rèn luyện các kỹ năng</h1>


            <h3>ĐỌC</h3>

            Mỗi lần bạn làm bài luyện đọc, hệ thống đưa ra cho bạn 3 dạng bài khác nhau ứng với 3 bài tập.
            Bạn sẽ có 20 phút để hoàn thành bài làm của mình. Sau khi hết thời gian mà bạn chưa gửi bài, hệ thống sẽ
            tự động gửi bài và trả về kết quả điểm cho bạn.
            Trong quá trình làm bài, bạn có thể hủy bỏ bài của bạn và bắt đầu bài mới.

            <p class="p-result">Lần thi gần nhất: {{$results_read->point}} điểm <span> vào ngày {{Carbon\Carbon::parse($results_read->created_at)->format('d/m/Y - H:i')}}</span> </p>

            <h3>Nghe</h3>

            Mỗi lần bạn làm bài luyện đọc, hệ thống đưa ra cho bạn 3 dạng bài khác nhau ứng với 3 bài tập.
            Mỗi dạng bài có một audio.
            Bạn sẽ có 20 phút để nghe và hoàn thành bài làm của mình. Sau khi hết thời gian mà bạn chưa gửi bài, hệ thống sẽ
            tự động gửi bài và trả về kết quả điểm cho bạn.
            Trong quá trình làm bài, bạn có thể hủy bỏ bài của bạn và bắt đầu bài mới.
            <p class="p-result">Lần thi gần nhất: {{$results_listen->point}} điểm <span> vào ngày {{Carbon\Carbon::parse($results_listen->created_at)->format('d/m/Y - H:i')}} </span> </p>

            <h3> Nói</h3>

            Mỗi lần bạn làm bài luyện nói, hệ thống đưa ra cho bạn 1 câu hoặc đoạn văn và yêu cầu bạn nhắc lại đoạn văn đó.
            Bạn chọn nút Start để bắt đầu phần ghi âm, Stop để kết thúc ghi âm. Để chấm điểm phần nói của mình, bạn chọn nút Check.
            Hệ thống sẽ ghi âm và chuyển giọng nói của bạn về dạng chữ. Sau đó so sánh và thông báo kết quả cho bạn.
            Để chuyển sang câu tiếp theo, bạn bấm nút Next.
            <p class="p-result">Lần thi gần nhất: {{$results_speak->point}} điểm <span> vào ngày {{Carbon\Carbon::parse($results_speak->created_at)->format('d/m/Y - H:i')}} </span> </p>

        </div>


    </div>
</div>
