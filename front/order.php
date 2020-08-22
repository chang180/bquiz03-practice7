<h1 class="ct">線上訂票</h1>
<form id="order-form">
    <div class="ct">
        <div>電影：<select name="name" id="name">
                <?php
                $movies = $Movie->all();
                foreach ($movies as $m) {
                    @$chk = ($_GET['id'] == $m['id']) ? "selected" : "";
                    echo "<option $chk>" . $m['name'] . "</option>";
                }
                ?>
            </select></div>
        <div>日期：<select name="date" id="date">
                <?php
                $today = date("Y-m-d");
                for ($i = 1; $i <= 3; $i++) {
                    echo "<option>$today</option>";
                    $today = date("Y-m-d", strtotime("$today +1 days"));
                }
                ?>
            </select></div>
        <div>場次：<select name="session" id="session">
                <?php for ($i = 1; $i <= 5; $i++) {
                    echo "<option value='" . $session[$i] . "'>$session[$i] 剩餘座位20</option>";
                }
                ?>
            </select></div>
        <div class="ct"><button type="button" onclick="booking()">確認</button><button type="reset">重置</button></div>
    </div>
</form>
<div id="seat-form" style="display:none">
    <div class="ct" id="seat"></div>
    <div class="ct">
        <div>您選擇的電影是：<span id="mName"></span></div>
        <div>你選擇的時刻是：<span id="mDate"></span>&nbsp;<span id="mSession"></span></div>
        <div>您已經勾選了<span id="mTicket">0</span>張票，最多可以購買4張票</div>
    </div>
    <div class="ct">
        <button type="button" onclick="prev()">上一步</button><button id="send" type="button">訂購</button>
    </div>
</div>
<script>
    let name, date, session, seat = [],
        ticket = 0;

    function booking() {
        $("#order-form,#seat-form").toggle();
        name = $("#name").val();
        $("#mName").text(name);
        date = $("#date").val();
        $("#mDate").text(date);
        session = $("#session").val();
        $("#mSession").text(session);
        $.post("api/getseat.php", {
            name,
            date,
            session
        }, function(res) {
            $("#seat").html(res);
            $(".seat").on("change", function() {
                if (this.checked) {
                    if (ticket > 3) this.checked = false;
                    else {
                        ticket++;
                        seat.push(this.value);
                    }
                } else {
                    ticket--;
                    seat.splice(seat.indexOf(this.value), "1");
                }
                $("#mTicket").text(ticket);
                $("#send").on("click", function() {
                    $.post("api/order.php", {
                        name,
                        session,
                        date,
                        seat
                    }, function(no) {
                        location.href = `?do=result&no=${no}`;
                    })
                })
            })

        })
    }

    function prev() {
        $("#order-form,#seat-form").toggle();
        $("#seat").html("");

    }
</script>