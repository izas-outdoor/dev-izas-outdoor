import os

from celery import Celery

# Set the default Django settings module for the 'celery' program.
os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'izas.settings')
from django.conf import settings

app = Celery('izas',
             broker='redis://localhost:6379/0',
             backend='redis://localhost:6379/0')
app.config_from_object('django.conf:settings', namespace='CELERY')
app.conf.update(
    task_serializer='json'
)
# Use synchronous tasks in local dev
if settings.DEBUG:
    app.conf.update(task_always_eager=True)
app.autodiscover_tasks(lambda: settings.INSTALLED_APPS, related_name='celery')
