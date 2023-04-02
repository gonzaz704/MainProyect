<style>
    .facebook-share-button {
        background: #3B5998;
        color: white;
    }
    .twitter-share-button {
        background: #55ACEE;
        color: white;
    }
    .social-div {
        width: auto;
        margin: 10px auto;
        text-align: center;
    }
    .share-btn {
        display: inline-block;
        color: #fff;
        padding: 7px;
        width: 100px;
        border-radius: 4px;
    }
</style>

<div class="social-div">
    <a href="{{ route('data.share',$item->id) }}"
       class="twitter-share-button share-btn"
       data-size="large"
       data-show-count="false"><i class="fa fa-twitter" aria-hidden="true"></i> Tweet
    </a>&nbsp;
    <a href="{{ route('data.share',$item->id) }}" class="facebook-share-button share-btn"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
</div>