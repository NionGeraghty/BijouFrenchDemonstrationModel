import { ActivitiesServices } from './activities.service';
import { ArticlesServices } from './articles.service';
import { CohortsServices } from './cohorts.service';
import { CoursesServices } from './courses.service';
import { SongsServices } from './songs.service';

export class Services {
	cohorts: CohortsServices;
	courses: CoursesServices;
	articles: ArticlesServices;
	activities: ActivitiesServices;
	songs: SongsServices;

	constructor() {
		this.cohorts = new CohortsServices();
		this.courses = new CoursesServices();
		this.articles = new ArticlesServices();
		this.activities = new ActivitiesServices();
		this.songs = new SongsServices();
	}
}
