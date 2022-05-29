<template>
    <div class="card-footer">
        <form
            class="d-flex col-12 px-0 align-self-start"
            action="/comment"
            method="POST"
        >
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="postUserId" :value="post.user.id" />
        <input type="hidden" name="postId" :value="post.id" />
            <textarea
                class="col-11 border-0 form-control"
                name="body"
                id="floatingTextarea"
                cols="10"
                rows="2"
                placeholder="コメントをする"
            ></textarea>
            <button type="submit" class="btn px-0 mx-auto">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>
    </div>
</template>
<script>
export default {
    props: {
        post: {},
        isIndex: {
            type: Boolean,
            default: false,
        },
    },
    data:function (){
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }
};
</script>
