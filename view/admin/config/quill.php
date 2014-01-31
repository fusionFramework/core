function() //Should always be an anonymous function do your logged in user check here and return the id or null
{
	// If a user is logged in
	if(Sentry::check())
	{
		return Sentry::getUser()->id;
	}

	//nope none is logged in
	return null;
}