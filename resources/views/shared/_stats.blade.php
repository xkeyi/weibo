<a href="{{ route('users.followings', $user->id) }}">
  <strong id="following" class="stat">
    {{ count($user->followings) }}
  </strong>
  关注
</a>
<a href="{{ route('users.followers', $user->id) }}">
  <strong id="followers" class="stat">
    {{ count($user->followers) }}
  </strong>
  粉丝
</a>
<a href="{{ route('users.show', $user->id) }}">
  <strong id="statuses" class="stat">
    <!-- 应该把用户的关注、粉丝、微博数放在缓存中，每次有更新的时候去更新缓存，而不是直接从数据库中读取统计 -->
    {{ $user->statuses()->count() }}
  </strong>
  微博
</a>
