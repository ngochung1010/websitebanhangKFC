<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<!-- đoạn scrip sử lý đơn hàng -->
<script>
    $('.xulydonhang').change(function(){
        const value = $(this).val();
        const madonhang = $(this).find(':selected').attr('id'); 
        if(value==0){
            alert('Bạn hãy chọn xử lý đơn hàng.');
        }
        else
        {
            $.ajax({
                method:'POST',
                url:'/donhang/xuly',
                data:{value:value, madonhang:madonhang},
                success:function(){
                    alert('Thay đổi thuộc tính đơn hàng thành công.');
                }
            })
        }
    })
</script>
</body>
</html>  