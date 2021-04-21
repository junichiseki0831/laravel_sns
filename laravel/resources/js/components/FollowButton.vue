<template>
  <div>
    <button
      class="btn-sm shadow-none border border-primary p-2"
      :class="buttonColor"
      @click="clickFollow" 
    >
      <i
        class="mr-1"
        :class="buttonIcon"
      ></i>
      {{ buttonText }}
    </button>
  </div>
</template>

<script>
  export default {
    props: {
      // $user->isFollowedBy(Auth::user())の結果(json)
      initialIsFollowedBy: {
        type: Boolean,
        default: false,
      },
      // :authorized='@json(Auth::check())'の結果
      authorized: {
        type: Boolean,
        default: false,
      },
      // endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
      endpoint: {
        type: String,
      },
    },
    // デフォルトはfalse
    data() {
      return {
        isFollowedBy: this.initialIsFollowedBy,
      }
    },
    computed: {
      // isFollowedByの状態により色変更
      buttonColor() {
        return this.isFollowedBy
          ? 'bg-primary text-white'
          : 'bg-white'
      },
      // isFollowedByの状態によりアイコン変更
      buttonIcon() {
        return this.isFollowedBy
          ? 'fas fa-user-check'
          : 'fas fa-user-plus'
      },
      // isFollowedByの状態により文言変更
      buttonText() {
        return this.isFollowedBy
          ? 'フォロー中'
          : 'フォロー'
      },
    },
    methods: {
      clickFollow() {
        if (!this.authorized) {
          alert('フォロー機能はログイン中のみ使用できます')
          return
        }

        // フォロー中であればunfollowメソッド、フォローしていなければfollowメソッドを実行
        this.isFollowedBy
          ? this.unfollow()
          : this.follow()
      },

      async follow() {
        // async/awaitで非同期処理を簡潔に書く
        // axios.put(this.endpoint)は、URIusers/{name}/followに対して、HTTPのPUTメソッドでリクエスト
        const response = await axios.put(this.endpoint)

        // isFollowedByにtrueを代入しフォローボタンはフォロー中の表示になる
        this.isFollowedBy = true

        // responseには、axiosによるHTTP通信の結果が代入され、response.dataとすることでレスポンスのボディ部にアクセスできる。
        // response.data.nameとすることで、フォローしたユーザー名を取得できる。
      },
      
      async unfollow() {
        const response = await axios.delete(this.endpoint)

        this.isFollowedBy = false
      },
    },
  }
</script>
